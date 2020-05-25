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
use App\SectorOportunity;
use App\Profesion;
// use App\Skill;
use App\StatusOportunity;

class OportunyController extends Controller
{
    // public function _construct(){
        
    //     $this->middleware('auth');

    // }

    public function index(){
        $user_id=\Auth::user()->id;
        $oportunitys=Oportunity::where('user_id',$user_id)->orderByDesc('updated_at')->paginate(10);
        return view('oportunitys.oportunitySaved',['oportunitys'=> $oportunitys]);
    }

    public function showRegistrationOportunity($oportunity = null){

        $typeOportunitys = TypeOportunity::all();
        $jobTypes = JobType::all();
        $ubicationOportunitys = UbicationOportunity::all();
        $statusOportunity=StatusOportunity::all();
        $user=\Auth::user();
        $sectorOportunity=CompanyAnsweredSurvey::where('user_id',$user->id)->value('option_index');
        $sectorName=SectorOportunity::where('id',$sectorOportunity)->value('description');
        $sectorsAll=SectorOportunity::all(); /*Por definir como funcionará*/
        $profesionsAll=Profesion::all(); /*Por definir como funcionará*/
        $profesions=Profesion::where('sector_id',$sectorOportunity )->get();
        $oportunity=isset($oportunity) ? Oportunity::find((int)$oportunity) : '';
        
        // var_dump($oportunity); die();

        return view('oportunitys.oportunityForm',[
            'typeOportunitys'=>$typeOportunitys,
            'jobTypes'=>$jobTypes,
            'ubicationOportunitys'=>$ubicationOportunitys, 
            'sectorOportunity'=> $sectorOportunity,
            'profesions'=> $profesions,
            'sectorName'=> $sectorName,
            'oportunity'=> $oportunity,
            'statusOportunity'=> $statusOportunity,
            'sectorsAll'=>$sectorsAll,
            'profesionAll'=>$profesionsAll
        ]);
    }

    public function store(Request $request){
        
        $request->validate([
            'profesion' => 'required|string|max:255',
            'ubication' => 'required|string|max:255',
            'functions' => 'required|string|max:255',
            'jobType' => 'required',
            'ubicationOportunity' => 'required',
            'description' => 'required|string',
            'sectors' => 'required',
            'functions'=>'required',
            'skills'=>'required'

        ]);

        //Sectores
            // $sectors = [];

        $sectors=implode(',', $request->input('sectors'));
        $functions=implode(',', $request->input('functions'));
        $skills=implode(',', $request->input('skills'));
        // $sectors=$request->input('sectors');
            // var_dump($functions); die(); 

        if ($request->has('publicar')){
            $estatus=2;
            // var_dump($estatus); die();
        }else if ($request->has('borrador')){
            $estatus=1;
        }else if($request->has('newstatus')){
            $estatus=$request->input('statusOportunity');
        }

        $oportunity = Oportunity::updateOrCreate(
            ['id'=>$request->oportunity_id,
             'user_id' => auth()->user()->id],
            ['job_type_id' =>  $request->jobType,
             'ubication_oportunity_id' => $request->ubicationOportunity,
             'sector_id' =>   $request->sector_id,
             'status_id' => (int)$estatus,
             'description' =>   $request->description,
             'cargo' =>  $request->profesion,
             'sectors' =>   $sectors,
             'skills' =>   $skills,
             'functions' =>   $functions,
             'ubication' =>  $request->ubication,
             'email_contact' =>   $request->email_contact,
             'web' =>   $request->web,
             
            ]
        );
        return redirect()->route('oportunity.saved');
        
    }

    public function getImage($filename){
        $file=Storage::disk('oportunitys')->get($filename);
        return new Response($file, 200);
    }
}
