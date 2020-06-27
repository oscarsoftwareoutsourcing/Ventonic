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
            $neg_types = NegotiationType::all(); // Negotiation types.
            $neg_statuses = NegotiationStatus::all(); // Negotiation statuses.
            $user_neg_processes = User::find(auth()->user()->id)->negotiation_processes; // Negotiation processes.
            $negotiations = User::find(auth()->user()->id)->negotiations; // Negotiations

            // Return the data to the view
            return view('negotiations.index')->with([
                'negTypes' => $neg_types,
                'negStatuses' => $neg_statuses,
                'negProcesses' => $user_neg_processes[0]['labels'],
                'negotiations' => $negotiations,
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
