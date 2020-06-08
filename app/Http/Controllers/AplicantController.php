<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\CompanyAplicantOportunity ;
use App\Notifications\SellerAplicantOportunity;
use App\Oportunity;
use App\Aplicant;
use App\User;
use App\Question;
use App\SellerProfile;
use App\SellerAnsweredSurvey;
use App\Events\PostulationOportunity;
use App\StatusPostulation;

class AplicantController extends Controller
{
    public function store(Request $request){
        $id_oportunity=$request->input('oportunity_id');
        $oportunity=Oportunity::find($id_oportunity);
        $company_id=$oportunity->user_id;
        $seller=auth()->user()->id;
        $status=1;
        
        // Datos para el email
        $oportunity_title=$oportunity->title;
        $seller_name=auth()->user()->name;

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
             'status_postulations_id' => $status,
             'favorite' => false             
            ]
        );

        // Notificar por correo
        $recipient_seller=User::find(auth()->user()->id);
        $recipient_company=User::find($company_id);

        $recipient_seller->notify(new SellerAplicantOportunity($postulation, $oportunity_title));
        $recipient_company->notify(new CompanyAplicantOportunity($postulation, $oportunity_title, $seller_name));
        $recipient_seller->notify(new CompanyAplicantOportunity($postulation, $oportunity_title, $seller_name));

        // Notificaciones
        // event(new PostulationOportunity($postulation));

        // return
        return view('oportunitys.oportunitys', ['oportunitys'=> $oportunitys]);
    }


    public function myaplicants($oportunity_id){
        $aplicants=Aplicant::where('oportunity_id', (int)$oportunity_id)->paginate(25);
        $status_postulation=StatusPostulation::all();
        return view('oportunitys.myaplicants', [
                    'aplicants'=>$aplicants,
                    'status_postulation'=>$status_postulation
        ]);
    }

    public function profilePostulant($id){
        $seller_profile=SellerProfile::where('user_id',(int)$id)->first();
        $array_answered=SellerAnsweredSurvey::where('user_id',$id)->get();
        $questions=Question::all();
        $answered=null;
        // // $array_question=explode(",",$questions);
        // // var_dump($array_question); die();
        //foreach($questions as $question){
        //     var_dump($question->options);
        // }
        //  die();
        // foreach($array_answered as $answered){

        // }
        // var_dump($seller_profile->answered); die();
        return view('oportunitys.profile',[
            'seller_profile'=>$seller_profile,
            'questions'=>$questions
        ]);

    }

    public function updateStatus($id, $estatus_postulations_id){
        $aplicant=Aplicant::find($id);
        $aplicant->status_postulations_id=(int)$estatus_postulations_id;
        $aplicant->update();
        if($aplicant->update()){
            return response()->json(['status'=>'success','message'=>'Estatus modificado exitosamente']); 
        }
    }

}
