<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\SellerProfile;
use App\User;
use App\UserModuleLabel;
use App\NegotiationType;
use App\NegotiationStatus;
use App\Negotiation;
use Carbon\Carbon;

class NegotiationController extends Controller
{
    public function index(){

        try {

            // Get all the information needed in the module.
            $contacts = User::find(auth()->user()->id)->contact;
            $neg_types = NegotiationType::all(); // Negotiation types.
            $neg_statuses = NegotiationStatus::all(); // Negotiation statuses.

            // We check if user has negotiation processes already in the DB.
            $user_neg_processes = User::find(auth()->user()->id)->negotiation_processes; // Negotiation processes.
            if(count($user_neg_processes) === 0) { // User doesn't have negotiation processes in the DB.
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
                $userModuleLabel->created_at = date('Y-m-d H:i:s');
                $userModuleLabel->updated_at = NULL;

                $userModuleLabel->save();

                $user_neg_processes = $userModuleLabel;

                $processes = $userModuleLabel['labels'];
            } else {
                $processes = $user_neg_processes[0]['labels'];
            }


            $negotiations = User::find(auth()->user()->id)->negotiations; // Negotiations

            // Return the data to the view
            return view('negotiations.index')->with([
                'userContacts' => $contacts,
                'negTypes' => $neg_types,
                'negStatuses' => $neg_statuses,
                'negProcesses' => $processes,
                'negotiations' => $negotiations,
                'userId' => auth()->user()->id
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function saveNegotiation(Request $request) {
        try {

            if($request->id !== null) {
                $negotiation = Negotiation::find($request->id);
                $negotiation->neg_status_id = $request->neg_status_id;
                if($request->neg_status_id === 1) {
                    $negotiation->neg_process_id = 6;
                } else {
                    $negotiation->neg_process_id = $request->neg_process_id;
                }
            } else {
                $negotiation = new Negotiation;
                $negotiation->neg_status_id = 3;
                $negotiation->neg_process_id = $request->neg_process_id;
            }
            
            $negotiation->user_id = $request->user_id;
            $negotiation->contact_id = $request->contact_id;
            $negotiation->neg_type_id = $request->neg_type_id;
            $negotiation->title = $request->title;
            $negotiation->description = $request->description;
            $negotiation->amount = str_replace(',', '.', $request->amount);
            $negotiation->active = $request->active;
            $negotiation->deadline = Carbon::parse($request->deadline)->toDateTimeString();
            $negotiation->created_at = date('Y-m-d H:i:s');
            $negotiation->updated_at = NULL;

            $negotiation->save();

            $negotiations = User::find($request->user_id)->negotiations;

            return response()->json([
                'result' => true,
                'newNegotiations' => $negotiations
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function updateList(Request $request, $id) {
        try {
            $negotiation = Negotiation::find($id);
            $negotiation->neg_process_id = $request->processId;
            $negotiation->save();

            return response()->json([
                'result' => true,
                'updated_neg' => $negotiation
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function updateStatus(Request $request, $id) {
        try {
            $negotiation = Negotiation::find($id);
            $negotiation->neg_status_id = $request->statusId;

            if($request->statusId === 1) {
                $negotiation->neg_process_id = 6;
            }

            $negotiation->save();

            $negotiations = User::find($negotiation->user_id)->negotiations;

            return response()->json([
                'result' => true,
                'newNegotiations' => $negotiations
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function toggleActiveNegotiation(Request $request) {
        try {

            $negotiation = Negotiation::find($request->id);
            $negotiation->active = !$request->active;
            $negotiation->save();

            $negotiations = User::find($negotiation->user_id)->negotiations;

            return response()->json([
                'result' => true,
                'newNegotiations' => $negotiations
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
