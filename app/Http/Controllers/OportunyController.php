<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\Controller;
use App\User;
use App\JobType;
use App\TimeZoneOportunity;
use App\TypeOportunity;
use App\UbicationOportunity;
use App\CompanyAnsweredSurvey;
use App\Oportunity;
use App\Profesion;

class OportunyController extends Controller
{
    // public function _construct(){
        
    //     $this->middleware('auth');

    // }

    public function index(){

        return view('oportunitys.oportunity');
    }

    public function showRegistrationOportunity(){
        $typeOportunitys = TypeOportunity::all();
        $timeZoneOportunitys = TimeZoneOportunity::all();
        $jobTypes = JobType::all();
        $ubicationOportunitys = UbicationOportunity::all();
        $user=\Auth::user();
        $sectorOportunity=CompanyAnsweredSurvey::where('user_id',$user->id)->value('option_index');
        $profesions=Profesion::where('sector_id',$sectorOportunity )->get();
        // var_dump($profesions); die();

        return view('oportunitys.oportunityForm',[
            'typeOportunitys'=>$typeOportunitys,
            'timeZoneOportunitys'=>$timeZoneOportunitys,
            'jobTypes'=>$jobTypes,
            'ubicationOportunitys'=>$ubicationOportunitys, 
            'profesions'=> $profesions
        ]);
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'typeOportunity' => 'required',
            'jobType' => 'required',
            'profesion' => 'required',
            'ubicationOportunity' => 'required',
            'timeZoneOportunity' => 'required',

        ]);

        $user_id=\Auth::user()->id;
        $estatus='borrador';
        $typeOportunity=$request->input('typeOportunity');
        $profesion=$request->input('profesion');
        $jobType=$request->input('jobType');
        $ubicationOportunity=$request->input('ubicationOportunity');
        $timeZone=$request->input('timeZoneOportunity');
        
        if ($request->has('borrador'))
        {
            $estatus='borrador';
        }
        else if ($request->has('publicada'))
        {
            $estatus='publicada';
        }

        $oportunity = new Oportunity();
        $oportunity->user_id = (int)$user_id;
        $oportunity->type_oportunity_id = (int)$typeOportunity;
        $oportunity->job_type_id = (int)$jobType;
        $oportunity->ubication_oportunity_id = (int)$ubicationOportunity;
        $oportunity->time_zone_id = (int)$timeZone;
        $oportunity->profesion_id = (int)$profesion;
        $oportunity->estatus = $estatus;
        // $oportunity->skill_id = '';
        $oportunity->save();
            
        if ($oportunity->estatus=='borrador')
        {
            // Envio todos los campos a la vista para continuar la construccion de la oportunidad
            $oportunityDraft=Oportunity::find($oportunity->id);
            $typeOportunitys = TypeOportunity::all();
            $timeZoneOportunitys = TimeZoneOportunity::all();
            $jobTypes = JobType::all();
            $ubicationOportunitys = UbicationOportunity::all();
            $user=\Auth::user();
            $sectorOportunity=CompanyAnsweredSurvey::where('user_id',$user->id)->value('option_index');
            $profesions=Profesion::where('sector_id',$sectorOportunity )->get();
            // var_dump($oportunityDraft); die();
            
            return view('oportunitys.oportunityDraft', [
                'oportunityDraft'=>$oportunityDraft,
                'typeOportunitys'=>$typeOportunitys,
                'timeZoneOportunitys'=>$timeZoneOportunitys,
                'jobTypes'=>$jobTypes,
                'ubicationOportunitys'=>$ubicationOportunitys, 
                'profesions'=> $profesions
                ])
                  ->with(['message' => 'Borrador creado exitosamente']);
        }
        else if ($request->has('publicada'))
        {

            die();
    
        }
        

        // $oportunity->skill_id = $skill_id;
    }

    public function save(Request $request){

        $validatedData = $request->validate([
            'typeOportunity' => 'required',
            'jobType' => 'required',
            'profesion' => 'required',
            'ubicationOportunity' => 'required',
            'timeZoneOportunity' => 'required',

        ]);

        // Recoger los datos
        $oportunityDraft_id=$request->input('oportunity_id');
        $typeOportunity=$request->input('typeOportunity');
        $profesion=$request->input('profesion');
        $jobType=$request->input('jobType');
        $ubicationOportunity=$request->input('ubicationOportunity');
        $timeZone=$request->input('timeZoneOportunity');
        $user_id=\Auth::user()->id;
        $title=$request->input('title');
        $description=$request->input('description');
        $skills=$request->input('skills');
        $experience=$request->input('experience');
        $image=$request->file('image');
            

        if ($request->has('guardada'))
        {
            $estatus='guardada';
        }
        else if ($request->has('previa'))
        {
            $estatus='previa';
        }
        else
        {
            $estatus='borrador';
        }


        // Actualizamos con nuevos campos
        $oportunityDraft=Oportunity::find($oportunityDraft_id);

        $oportunityDraft->user_id = (int)$user_id;
        $oportunityDraft->type_oportunity_id = (int)$typeOportunity;
        $oportunityDraft->job_type_id = (int)$jobType;
        $oportunityDraft->ubication_oportunity_id = (int)$ubicationOportunity;
        $oportunityDraft->time_zone_id = (int)$timeZone;
        $oportunityDraft->profesion_id = (int)$profesion;
        $oportunityDraft->estatus = $estatus;
        $oportunityDraft->title = $title;
        $oportunityDraft->description = $description;
        $oportunityDraft->skill_id = $skills;
        $oportunityDraft->experience = $experience;

        if($image){
            $image_path_name = time().$image->getClientOriginalName();
            Storage::disk('oportunitys')->put($image_path_name, File::get($image));
            $oportunityDraft->image = $image_path_name;
        }

        $oportunityDraft->update();
                
        if ($oportunityDraft->estatus=='guardada')
        {
            // Envio todos los campos a la vista para continuar la construccion de la oportunidad
            $typeOportunitys = TypeOportunity::all();
            $timeZoneOportunitys = TimeZoneOportunity::all();
            $jobTypes = JobType::all();
            $ubicationOportunitys = UbicationOportunity::all();
            $user = \Auth::user();
            $sectorOportunity = CompanyAnsweredSurvey::where('user_id', $user->id)->value('option_index');
            $profesions = Profesion::where('sector_id', $sectorOportunity)->get();
            
            return view('oportunitys.oportunityDraft', [
                'oportunityDraft'=>$oportunityDraft,
                'typeOportunitys'=>$typeOportunitys,
                'timeZoneOportunitys'=>$timeZoneOportunitys,
                'jobTypes'=>$jobTypes,
                'ubicationOportunitys'=>$ubicationOportunitys, 
                'profesions'=> $profesions
                ])->with(['message' => 'Borrador creado exitosamente']);
        }
        else if ($oportunityDraft->estatus=='previa')
        {
            $estatus='previa';
        }
        else
        {
            $estatus='borrador';
        }
  
    }

    public function getImage($filename){
        $file=Storage::disk('oportunitys')->get($filename);
        return new Response($file, 200);
    }

}
