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
use App\Negotiation;
use App\Group;
use App\Note;
use App\Event;
use App\Email;

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
                $userModuleLabel->created_at = date('Y-m-d H:i:s');
                $userModuleLabel->updated_at = null;

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
            $negotiation->created_at = date('Y-m-d H:i:s');
            $negotiation->updated_at = null;

            // Save negotiation.
            $negotiation->save();

            // We check if we need to relate users.
            if (count($request->groups) > 0) {
                $ids = $this->getIdsInGroup($request->groups);

                $negotiation->related_users()->sync($ids);
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
            $negotiation = Negotiation::find($id);
            $negotiation->neg_process_id = $request->processId;
            $negotiation->save();

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
            }

            $negotiation->save();

            return response()->json([
                'result' => true,
                'updated_neg' => new NegotiationsResource($negotiation)
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

    /**
     * Registra una nota para una negociación
     *
     * @method    setNote
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request    $request    Objeto con la respuesta a la petición
     *
     * @return    JsonResponse Objeto con información de respuesta
     */
    public function setNote(Request $request)
    {
        $this->validate($request, [
            'description' => ['required'],
            'negotiation_id' => ['required']
        ], [
            'description.required' => 'Debe indicar una nota'
        ]);
        Note::create([
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'noteable_id' => $request->negotiation_id,
            'noteable_type' => Negotiation::class
        ]);
        return response()->json(['result' => true], 200);
    }

    /**
     * Listado de notas asociadas a una negociación
     *
     * @method    getNotes
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Negotiation      $negotiation    Objeto con datos de la negociación
     *
     * @return    JsonResponse Objeto con información de respuesta
     */
    public function getNotes(Negotiation $negotiation)
    {
        return response()->json(['result' => true, 'notes' => $negotiation->notes], 200);
    }

    /**
     * Registra un evento asociado a una negociación
     *
     * @method    setEvent
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request     $request    Objeto con información de la petición
     *
     * @return  JsonResponse  Objeto con los datos de respuesta a la petición
     */
    public function setEvent(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
            'start_at' => ['required', 'date'],
            'start_time' => ['required'],
            'end_at' => ['required', 'date', 'after_or_equal:start_at'],
            'end_time' => ['required', 'after_or_equal:start_time']
        ], [
            'title.required' => 'Dato requerido',
            'start_at.required' => 'Dato requerido',
            'start_at.date' => 'Debe tener un formato válido',
            'start_time.required' => 'Dato requerido',
            'end_at.required' => 'Dato requerido',
            'end_at.date' => 'Debe tener un formato válido',
            'end_at.after_or_equal' => 'Debe ser posterior a Fecha de Inicio',
            'end_time.required' => 'Dato requerido',
            'end_time.after_or_equal' => 'Debe ser posterior a Hora de Inicio'
        ]);

        $start = strtotime($request->start_at. ' '.$request->start_time);
        $end = strtotime($request->end_at. ' '.$request->end_time);

        $startDate = date("Y-m-d H:i:s", $start);
        $endDate = date("Y-m-d H:i:s", $end);

        Event::create([
            "category" => $request->category ?? 'O',
            'title' => $request->title,
            'start_at' => $startDate,
            'end_at' => $endDate,
            'notes' => $request->description,
            'place' => $request->place ?? null,
            'user_id' => auth()->user()->id,
            'eventable_id' => $request->negotiation_id,
            'eventable_type' => Negotiation::class
        ]);

        return response()->json(['result' => true], 200);
    }

    /**
     * Obtiene el listado de eventos asociados a una negociación
     *
     * @method    getEvents
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Negotiation    $negotiation    Objeto con datos de la negociación
     *
     * @return    JsonResponse   Objeto con datos de respuesta a la petición
     */
    public function getEvents(Negotiation $negotiation)
    {
        return response()->json(['result' => true, 'events' => $negotiation->events], 200);
    }

    /**
     * Registra un correo a envíar asociado a una negociación
     *
     * @method    setEmail
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request     $request    Objeto con datos de la petición
     *
     * @return  JsonResponse  Objeto con información de respuesta a la petición
     */
    public function setEmail(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'subject' => ['required'],
            'message' => ['required']
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['result' => false, 'message' => 'El contacto no existe'], 200);
        }
        Email::create([
            'subject' => $request->subject,
            'message' => $request->message,
            'from_user_id' => auth()->user()->id,
            'to_user_id' => $user->id,
            'emailable_type' => Negotiation::class,
            'emailable_id' => $request->negotiation_id
        ]);
        Mail::to($user)->send(new NegotiationEmail($user->email, $user->name, $request->subject, $request->message));
        return response()->json(['result' => true], 200);
    }

    /**
     * Obtiene un listado de correos asociados a una negociación
     *
     * @method    getEmails
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Negotiation    $negotiation    Objeto con información de la negociación
     *
     * @return    JsonResponse   Objeto con datos de respuesta a la petición
     */
    public function getEmails(Negotiation $negotiation)
    {
        return response()->json(['result' => true, 'emails' => $negotiation->emails], 200);
    }
}
