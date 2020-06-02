<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SellerProfile;
use App\StatusNegociation;
use App\NegociationCompany;

class NegociationCompanyController extends Controller
{
    public function index(){
        $sellers=SellerProfile::get();
        $status=StatusNegociation::where('type', 'company')->get();
        $negociationsCompanys=NegociationCompany::orderByDesc('updated_at')->get();

        return view('negociationCompany.mynegociations', [
                                    'sellers' => $sellers,
                                    'status'  => $status,
                                    'negociationsCompanys'=> $negociationsCompanys
        ]);
    }

    public function store($seller_profile_id, $status_negociations_id, $producto, $responsable, $estimado){

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

    }
}
