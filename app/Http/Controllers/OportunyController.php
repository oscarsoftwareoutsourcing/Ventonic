<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\Controller;
use App\JobType;
use App\TypeOportunity;
use App\UbicationOportunity;
use App\Oportunity;
use App\SectorOportunity;
use App\StatusOportunity;
use App\Aptitud;

// use App\User;
// use App\TimeZoneOportunity;
// use App\CompanyAnsweredSurvey;
// use App\Profesion;
// use App\Skill;

class OportunyController extends Controller
{
    // public function _construct(){
        
    //     $this->middleware('auth');

    // }

    public function index(){
        $user_id=\Auth::user()->id;
        $oportunitys=Oportunity::where('user_id',$user_id)->orderByDesc('updated_at')->paginate(10);
        dd($oportunitys->aplicant);
        $sectors=SectorOportunity::all();
        $antiguedad=UbicationOportunity::all();
        $jobType=JobType::all();
        return view('oportunitys.myOportunitys',['oportunitys'=> $oportunitys, 
                                                'sectors'=>$sectors , 
                                                'antiguedad'=>$antiguedad,
                                                'jobType'=>$jobType]);
    }

    public function showAll(){
        $oportunitys=Oportunity::where('status_id',2)->orderByDesc('updated_at')->paginate(25);
        $sectors=SectorOportunity::all();
        $antiguedad=UbicationOportunity::all();
        $jobType=JobType::all();
        
        return view('oportunitys.oportunitys',['oportunitys'=> $oportunitys, 
                                               'sectors'=>$sectors , 
                                               'antiguedad'=>$antiguedad,
                                               'jobType'=>$jobType]);
    }

    public function showRegistrationOportunity($oportunity = null){

        $typeOportunitys = TypeOportunity::all();
        $jobTypes = JobType::all();
        $ubicationOportunitys = UbicationOportunity::all();
        $statusOportunity=StatusOportunity::all();
        $user=\Auth::user();
        $sectorsAll=SectorOportunity::all(); 
        $oportunity=isset($oportunity) ? Oportunity::find((int)$oportunity) : '';
        $aptitudes=Aptitud::all();
        

        return view('oportunitys.oportunityForm',[
            'typeOportunitys'=>$typeOportunitys,
            'jobTypes'=>$jobTypes,
            'ubicationOportunitys'=>$ubicationOportunitys,
            'statusOportunity'=> $statusOportunity,
            'sectorsAll'=>$sectorsAll,
            'oportunity'=> $oportunity,
            'aptitudes'=>$aptitudes

        ]);
    }

    public function store(Request $request){
        
        $request->validate([
            'title' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'ubication' => 'required|string|max:255',
            'functions' => 'required|string',
            'jobType' => 'required',
            'ubicationOportunity' => 'required',
            'description' => 'required|string',
            'skills' => 'required',
            'sectors' => 'required',

        ]);

        $sectors=implode(',', $request->input('sectors'));
        $skills=implode(',', $request->input('skills'));
        
        if ($request->has('publicar')){
            $estatus=2;
        }else if ($request->has('borrador') || $request->has('previa')){
            $estatus=1;
        }else if($request->has('newstatus')){
            $estatus=$request->input('statusOportunity');
        }

        $oportunity = Oportunity::updateOrCreate(
            ['id'=>$request->oportunity_id,
             'user_id' => auth()->user()->id],
            ['title' =>  $request->title,
             'job_type_id' =>  $request->jobType,
             'ubication_oportunity_id' => $request->ubicationOportunity,
             'status_id' => (int)$estatus,
             'description' =>   $request->description,
             'cargo' =>  $request->cargo,
             'sectors' =>   $sectors,
             'skills' =>   $skills,
             'functions' =>   $request->functions,
             'ubication' =>  $request->ubication,
             'email_contact' =>   $request->email_contact,
             'web' =>   $request->web,
             
            ]
        );

        if($request->has('previa')){
            $id=$oportunity->id;
            return redirect()->route('oportunity', ['id' => $id]);
        }
        else{
            return redirect()->route('oportunity.saved');
        }
        
    }

    public function showOportunity($id){
        $oportunity=Oportunity::find($id);
        $typeOportunitys = TypeOportunity::all();
        $jobTypes = JobType::all();
        $ubicationOportunitys = UbicationOportunity::all();
        $statusOportunity=StatusOportunity::all();
        $user=\Auth::user();
        $sectorsAll=SectorOportunity::all(); 
        $aptitudes=Aptitud::all();

        return view(
            'oportunitys.oportunity',[
                'typeOportunitys'=>$typeOportunitys,
                'jobTypes'=>$jobTypes,
                'ubicationOportunitys'=>$ubicationOportunitys,
                'statusOportunity'=> $statusOportunity,
                'sectorsAll'=>$sectorsAll,
                'oportunity'=> $oportunity,
                'aptitudes'=>$aptitudes,
            ]
        );

    }

    public function getImage($filename){
        $file=Storage::disk('oportunitys')->get($filename);
        return new Response($file, 200);
    }

}
