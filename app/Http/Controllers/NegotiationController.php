<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// use App\SellerProfile;
use Carbon\Carbon;
use App\Http\Resources\NegotiationsResource;
use App\Mail\Negotiation as NegotiationEmail;
use App\User;
use App\UserModuleLabel;
use App\NegotiationType;
use App\NegotiationStatus;
use App\NegotiationProcess;
use App\Negotiation;
use App\Group;
use App\Note;
use App\Event;
use App\Email;
use App\Document;
use App\Repositories\UploadRepository;

class NegotiationController extends Controller
{
    public function index()
    {
        try {
            // Get all the information needed in the module.
            $user = User::find(auth()->user()->id);
            $contacts = $user->contact; // User contacts (clients).
            $neg_types = NegotiationType::all(); // Negotiation types.
            $neg_statuses = NegotiationStatus::all(); // Negotiation statuses.
            $user_groups = $user->groups; // Groups of users to access the negotiations.

            // We check if user has negotiation processes already in the DB.
            $user_neg_processes = User::find(auth()->user()->id)->negotiation_processes; // Negotiation processes.
            if (count($user_neg_processes) === 0) { // User doesn't have negotiation processes in the DB.
                $userModuleLabel = new UserModuleLabel;
                $userModuleLabel->user_id = auth()->user()->id;
                $userModuleLabel->module_id = 2;
                $userModuleLabel->labels = json_encode([
                    'processes' => [
                        ["id" => 1, "title" => "Posibles Clientes"],
                        ["id" => 2, "title" => "Potencial Cliente"],
                        ["id" => 3, "title" => "En Contacto"],
                        ["id" => 4, "title" => "Reunión / Sesión"],
                        ["id" => 5, "title" => "En Negociación / Seguimiento"],
                        ["id" => 6, "title" => "Venta / Cerrado"],
                    ]
                ]);
                /*$userModuleLabel->created_at = date('Y-m-d H:i:s');
                $userModuleLabel->updated_at = null;*/

                $userModuleLabel->save();

                $user_neg_processes = $userModuleLabel;

                $processes = $userModuleLabel['labels'];
            } else {
                $processes = $user_neg_processes[0]['labels'];
            }

            // Created negotiations
            $userNegotiations = User::find(auth()->user()->id)->negotiations()->with([
                'type', 'status', 'contact', 'related_users.related_groups.group.groupUser'
            ])->get();

            // Shared negotiations
            $relatedNegotiations = User::find(auth()->user()->id)->related_negotiations()->with([
                'user', 'type', 'status', 'contact', 'related_users.related_groups.group.groupUser'
            ])->get();

            $merged = $userNegotiations->merge($relatedNegotiations);

            $result = json_encode(NegotiationsResource::collection($merged->all()));

            // Return the data to the view
            return view('negotiations.index')->with([
                'userContacts' => $contacts,
                'userGroups' => $user_groups,
                'negTypes' => $neg_types,
                'negStatuses' => $neg_statuses,
                'negProcesses' => $processes,
                'negotiations' => $result,
                'userId' => auth()->user()->id
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function saveNegotiation(Request $request)
    {
        try {
            // // Check if ID comes to update instead of create
            if ($request->id !== null) { // Update
                $negotiation = Negotiation::find($request->id);
                $negotiation->neg_status_id = $request->neg_status_id;
                if ($request->neg_status_id === 1) {
                    $negotiation->neg_process_id = 6;
                    $negotiation->won_status_date = Carbon::now();
                } else {
                    $negotiation->neg_process_id = $request->neg_process_id;
                }
            } else { // Create
                $negotiation = new Negotiation;
                $negotiation->neg_status_id = 3;
                $negotiation->neg_process_id = $request->neg_process_id;
            }

            // Set other props to save.
            $negotiation->user_id = $request->user_id;
            $negotiation->contact_id = $request->contact_id;
            $negotiation->neg_type_id = $request->neg_type_id;
            $negotiation->title = $request->title;
            $negotiation->description = $request->description;
            $negotiation->amount = str_replace(',', '.', $request->amount);
            $negotiation->active = $request->active;
            $negotiation->deadline = Carbon::parse($request->deadline)->toDateTimeString();
            /*$negotiation->created_at = date('Y-m-d H:i:s');
            $negotiation->updated_at = null;*/

            // Save negotiation.
            $negotiation->save();

            $negotiation->negotiationProcessHistories()->sync($negotiation->neg_process_id);
            $negotiation->negotiationStatusHistories()->sync($negotiation->neg_status_id);

            // We check if we need to relate users.
            if (count($request->groups) > 0) {
                $ids = $this->getIdsInGroup($request->groups);

                $negotiation->related_users()->sync($ids);
                $negotiation->groups()->sync($this->getGroupIds($request->groups));
            } else {
                $negotiation->related_users()->sync([]);
            }

            return response()->json([
                'result' => true,
                'negotiation' => new NegotiationsResource($negotiation)
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function updateList(Request $request, $id)
    {
        try {
            $process = NegotiationProcess::find($request->processId);
            $negotiation = Negotiation::find($id);
            $negotiation->neg_process_id = $process->id;
            $negotiation->won_status_date = ($process->conversion === 1) ? Carbon::now() : null;
            $negotiation->save();

            $negotiation->negotiationProcessHistories()->sync($negotiation->neg_process_id);

            return response()->json([
                'result' => true,
                'updated_neg' => new NegotiationsResource($negotiation)
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $negotiation = Negotiation::find($id);
            $negotiation->neg_status_id = $request->statusId;

            if ($request->statusId === 1) {
                $negotiation->neg_process_id = 6;
                $negotiation->negotiationProcessHistories()->sync($negotiation->neg_process_id);
            }

            $negotiation->save();

            $negotiation->negotiationStatusHistories()->sync($negotiation->neg_status_id);

            return response()->json([
                'result' => true,
                'updated_neg' => new NegotiationsResource($negotiation),
                'currentStatus' => $negotiation->status
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function toggleActiveNegotiation(Request $request)
    {
        try {
            $negotiation = Negotiation::find($request->id);
            $negotiation->active = !$request->active;
            $negotiation->save();

            return response()->json([
                'result' => true,
                'archivedNeg' => new NegotiationsResource($negotiation)
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    private function getIdsInGroup($arr)
    {
        $userIds = array();

        foreach ($arr as $group_id) {
            $usersArr = Group::find($group_id['id'])->groupUser;
            foreach ($usersArr as $user) {
                array_push($userIds, $user['user_id']);
            }
        }

        $userIds = array_unique($userIds);
        return $userIds;
    }

    private function getGroupIds($arr)
    {
        $groupIds = [];
        foreach ($arr as $group) {
            array_push($groupIds, $group['id']);
        }

        return $groupIds;
    }
}
