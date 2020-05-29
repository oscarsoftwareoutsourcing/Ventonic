<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\CompanyAplicantOportunity ;
use App\Notifications\SellerAplicantOportunity;
use App\Oportunity;
use App\Aplicant;
use App\User;
use App\Events\PostulationOportunity;


class AplicantController extends Controller
{
    public function store(Request $request){
        $id_oportunity=$request->input('oportunity_id');
        $oportunity=Oportunity::find($id_oportunity);
        $company_id=$oportunity->user_id;
        $seller=auth()->user()->id;
        
        // Datos para el email
        $oportunity_title=$oportunity->title;

        // Datos para la vista
        $oportunitys=Oportunity::where('status_id', 2)->orderByDesc('updated_at')->paginate(25);

        if($request->has('contact-directo')){
            $type_message='mensaje directo';
        }
        else if($request->has('sala-chat'))
        {
            $type_message='sala chat';
        }

        $postulation = Aplicant::updateOrCreate(
            ['user_id' => $seller,
             'oportunity_id'=>$request->oportunity_id],
            ['type-message' =>  $type_message,
             'message' =>  $request->message !== null ? $request->message : null,
             'estatus' => $request->status,
             'favorite' => false             
            ]
        );

        // Notificar por correo
        $recipient_seller=User::find(auth()->user()->id);
        $recipient_company=User::find($company_id);

        $recipient_seller->notify(new SellerAplicantOportunity($postulation, $oportunity_title));
        $recipient_company->notify(new CompanyAplicantOportunity($postulation, $oportunity_title));

        // Notificaciones

        return view('oportunitys.oportunitys', ['oportunitys'=> $oportunitys]);
    }
}
