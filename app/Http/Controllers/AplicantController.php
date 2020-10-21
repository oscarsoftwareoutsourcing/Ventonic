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
use App\Helpers\FormatTime;
use App\JobType;
use App\UbicationOportunity;
use App\SectorOportunity;
use App\Repositories\UploadRepository;

class AplicantController extends Controller
{
    public function store(Request $request, UploadRepository $up)
    {
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

        if ($request->has('contact-directo')) {
            $type_message='mensaje directo';
        } elseif ($request->has('sala-chat')) {
            $type_message='sala chat';
        }

        $video = null;
        if ($request->file('video')) {
            if ($up->upload($request->file('video'), 'oportunitys', false, false, false, true)) {
                $video = $up->getStored();
            }
        }

        $postulation = Aplicant::updateOrCreate(
            [
                'user_id' => $seller,
                'oportunity_id'=>$request->oportunity_id
            ],
            [
                'type-message' =>  $type_message,
                'message' =>  $request->message !== null ? $request->message : null,
                'status_postulations_id' => $status,
                'favorite' => false,
                'video' => $video
            ]
        );

        // Notificar por correo
        $recipient_seller=User::find(auth()->user()->id);
        $recipient_company=User::find($company_id);
        $postulation_new=Aplicant::first();

        $time=FormatTime::LongTimeFilter($postulation->created_at);

        $recipient_seller->notify(new SellerAplicantOportunity($postulation, $oportunity_title));
        $recipient_company->notify(new CompanyAplicantOportunity($postulation, $oportunity_title, $seller_name, $time));

        // Notificaciones
        // event(new PostulationOportunity($postulation));
        $sectors=SectorOportunity::all();
        $antiguedad=UbicationOportunity::all();
        $jobType=JobType::all();

        session()->flash('message', 'Postulación aplicada con éxito');

        return view('oportunitys.oportunitys', ['oportunitys'=> $oportunitys,
                                               'sectors'=>$sectors ,
                                               'antiguedad'=>$antiguedad,
                                               'ubications'=>$antiguedad,
                                               'jobType'=>$jobType]);
    }


    public function myaplicants($oportunity_id)
    {
        $aplicants=Aplicant::where('oportunity_id', (int)$oportunity_id)->paginate(25);
        $status_postulation=StatusPostulation::all();

        // respuestas para filtros
        $anios=Question::where('id', 2)->value('options');
        $anios=ltrim($anios, '[');
        $anios=rtrim($anios, ']');
        $anios=str_replace('\u00f1', 'ñ', $anios);
        $anios=str_replace('\u00e1', 'á', $anios);
        $anios_string=str_replace('"', '', $anios);
        $aniosArray=explode(',', $anios_string);

        $experiencia=Question::where('id', 3)->value('options');
        $experiencia=ltrim($experiencia, '[');
        $experiencia=rtrim($experiencia, ']');
        $experiencia=str_replace('"', '', $experiencia);
        $experiencia=str_replace('\u00e9', 'é', $experiencia);
        $experiencia_string=str_replace('\u00ed', 'í', $experiencia);
        $experienciaArray=explode(',', $experiencia_string);

        $disponibilidad=Question::where('id', 4)->value('options');
        $disponibilidad=ltrim($disponibilidad, '[');
        $disponibilidad=rtrim($disponibilidad, ']');
        $disponibilidad=str_replace('"', '', $disponibilidad);
        $disponibilidad_string=str_replace('\u00f1', 'ñ', $disponibilidad);
        $disponibilidadArray=explode(',', $disponibilidad_string);

        $colaboracion=Question::where('id', 5)->value('options');
        $colaboracion=ltrim($colaboracion, '[');
        $colaboracion=rtrim($colaboracion, ']');
        $colaboracion=str_replace('"', '', $colaboracion);
        $colaboracion=str_replace('\u00f1', 'ñ', $colaboracion);
        $colaboracion_string=str_replace('\u00f3', 'ó', $colaboracion);
        $colaboracionArray=explode(',', $colaboracion_string);

        // var_dump($colaboracionArray); die();

        return view('oportunitys.myaplicants', [
                    'aplicants'=>$aplicants,
                    'status_postulation'=>$status_postulation,
                    'anios'=>$aniosArray,
                    'experiencia'=>$experienciaArray,
                    'disponibilidad'=>$disponibilidadArray,
                    'colaboracion'=>$colaboracionArray

        ]);
    }

    public function profilePostulant($id)
    {
        $seller_profile=SellerProfile::where('user_id', (int)$id)->first();
        if (!$seller_profile) {
            return abort(404);
        }
        $array_answered=SellerAnsweredSurvey::where('user_id', $id)->get();
        $questions=Question::where('option_type', 'V')->get();
        $answered=null;
        // var_dump($seller_profile); die();
        // // $array_question=explode(",",$questions);
        // // var_dump($array_question); die();
        //foreach($questions as $question){
        //     var_dump($question->options);
        // }
        //  die();
        // foreach($array_answered as $answered){

        // }
        // var_dump($seller_profile->answered); die();
        return view('oportunitys.profile', [
            'seller_profile'=>$seller_profile,
            'questions'=>$questions
        ]);
    }

    public function updateStatus($id, $estatus_postulations_id)
    {
        $aplicant=Aplicant::find($id);
        $aplicant->status_postulations_id=(int)$estatus_postulations_id;
        $aplicant->save();
        return response()->json(['status'=>'success','message'=>'Estatus modificado exitosamente']);
    }
}
