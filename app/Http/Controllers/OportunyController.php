<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;
use App\CompanyProfile;
use App\SectorOportunity;
use App\JobType;
use App\TimeZoneOportunity;
use App\DetailOportunity;
use App\Aplicant;
use App\TypeOportunity;
use App\UbicationOportunity;
use App\CompanyAnsweredSurvey;
use App\Profesion;

class OportunyController extends Controller
{
    // public function _construct(){
        
    //     $this->middleware('auth');

    // }

    public function index(){

        return view('oportunity');
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

        return view('oportunityForm',[
            'typeOportunitys'=>$typeOportunitys,
            'timeZoneOportunitys'=>$timeZoneOportunitys,
            'jobTypes'=>$jobTypes,
            'ubicationOportunitys'=>$ubicationOportunitys, 
            'profesions'=> $profesions
        ]);
    }


}
