<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\SellerProfile;
use App\User;
use App\NegotiationType;
use App\NegotiationStatus;
use App\Negotiation;

class NegotiationController extends Controller
{
    public function index(){

        try {
            
            // Get all the information needed in the module.
            $contacts = User::find(auth()->user()->id)->contact;
            $neg_types = NegotiationType::all(); // Negotiation types.
            $neg_statuses = NegotiationStatus::all(); // Negotiation statuses.
            $user_neg_processes = User::find(auth()->user()->id)->negotiation_processes; // Negotiation processes.
            $negotiations = User::find(auth()->user()->id)->negotiations; // Negotiations

            // Return the data to the view
            return view('negotiations.index')->with([
                'userContacts' => $contacts,
                'negTypes' => $neg_types,
                'negStatuses' => $neg_statuses,
                'negProcesses' => $user_neg_processes[0]['labels'],
                'negotiations' => $negotiations,
                'userId' => auth()->user()->id
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function saveNegotiation(Request $request) {
        try {
            $negotiation = new Negotiation;
            $negotiation->user_id = $request->userId;
            $negotiation->contact_id = $request->contactId;
            $negotiation->neg_type_id = $request->negTypeId;
            $negotiation->neg_status_id = 3;
            $negotiation->neg_process_id = $request->negProcessId;
            $negotiation->title = $request->title;
            $negotiation->description = $request->description;
            $negotiation->amount = $request->amount;
            $negotiation->active = true;
            $negotiation->created_at = date('Y-m-d H:i:s');
            $negotiation->updated_at = NULL;

            $negotiation->save();

            return response()->json([
                'result' => true,
                'saved_neg' => $negotiation
            ]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    /* public function store($seller_profile_id, $status_negociations_id, $producto, $responsable, $estimado){

        $negociacion = NegociationCompany::updateOrCreate(
            ['user_id' => auth()->user()->id,
             'seller_profile_id' =>   $seller_profile_id,
             'status_negociations_id' => $status_negociations_id,
             'producto' => $producto,
             'responsable'=>$responsable,
             'importe'=>$estimado
            ]
        );
        if($negociacion){
            return response()->json(['status'=>'success','message'=>'Estatus modificado exitosamente']); 
        }

    } */
}
