<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

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
            'timeZoneOportunity' => 'required'
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
            $oportunityDraft=Oportunity::find($oportunity->id);
            // var_dump($oportunityDraft); die();
            
            return view('oportunitys.oportunityDraft', ['oportunityDraft'=>$oportunityDraft])
                  ->with(['message' => 'Borrador creado exitosamente']);
        }
        else if ($request->has('publicada'))
        {
            $estatus='publicada';
            die();
    
        }
        

        // $oportunity->skill_id = $skill_id;
    }

    public function draftOportunity($oportunityDraft){
        return view('oportunitys.oportunityDraft', ['oportunityDraft' => $oportunityDraft]);
    }


}
