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

            if($request->id !== null) {
                $negotiation = Negotiation::find($request->id);
            } else {
                $negotiation = new Negotiation;
            }
            
            $negotiation->user_id = $request->user_id;
            $negotiation->contact_id = $request->contact_id;
            $negotiation->neg_type_id = $request->neg_type_id;
            $negotiation->neg_status_id = 3;
            $negotiation->neg_process_id = $request->neg_process_id;
            $negotiation->title = $request->title;
            $negotiation->description = $request->description;
            $negotiation->amount = $request->amount;
            $negotiation->active = $request->active;
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
