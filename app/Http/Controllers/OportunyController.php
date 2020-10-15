<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

use App\JobType;
use App\TypeOportunity;
use App\UbicationOportunity;
use App\Oportunity;
use App\SectorOportunity;
use App\StatusOportunity;
use App\Aptitud;
use App\Aplicant;
use Carbon\Carbon;

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

    public function index(Request $request)
    {
        $user_id = auth()->user()->id;

        $oportunitys = Oportunity::where('user_id', $user_id)->orderByDesc('updated_at')->get();
        $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
            return ($oportunity->expire_at!==null && $oportunity->expire_at->format('d-m-Y') >= Carbon::now()) ||
                   $oportunity->expire_at===null;
        });
        $sectors=SectorOportunity::all();
        $ubications=UbicationOportunity::all();
        $jobType=JobType::all();

        $path = '';
        if ($request->_token) {
            $text = ($request->oportunitySearch!==null) ? str_replace(" ", "+", $request->oportunitySearch) : '';
            $path = '?_token=' . $request->_token .
                    '&oportunitySearch=' . $text .
                    '&jobType=' . $request->jobType .
                    '&ubication=' . $request->ubication .
                    '&sector=' . $request->sector .
                    '&expire_at=' . $request->expire_at;
            if ($request->oportunitySearch) {
                //Filtrar oportunidades por texto en búsqueda
                $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
                    $text = strtoupper($request->oportunitySearch);
                    return strpos(strtoupper($oportunity->title), $text) !== false ||
                           strpos(strtoupper($oportunity->description), $text) !== false ||
                           strpos(strtoupper($oportunity->cargo), $text) !== false ||
                           strpos(strtoupper($oportunity->functions), $text) !== false ||
                           strpos(strtoupper($oportunity->email_contact), $text) !== false ||
                           strpos(strtoupper($oportunity->web), $text) !== false ||
                           strpos(strtoupper($oportunity->jobType->description), $text) !== false ||
                           strpos(strtoupper($oportunity->ubicationOportunity->description), $text) !== false;
                });
            }
            if ((int)$request->jobType !== 0) {
                //Filtrar oportunidades por tipo de trabajo
                $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
                    return $oportunity->job_type_id === (int)$request->jobType;
                });
            }
            if ((int)$request->ubication !== 0) {
                //Filtrar oportunidades por ubication
                $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
                    return $oportunity->ubication_oportunity_id === (int)$request->ubication;
                });
            }
            if ((int)$request->sector !== 0) {
                //Filtrar oportunidades por sector
                $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
                    return strpos($oportunity->sectors, $request->sector) !== false;
                });
            }
            if ($request->expire_at) {
                //Filtrar oportunidades por fecha de caducidad
                $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
                    return $oportunity->expire_at!==null &&
                           $oportunity->expire_at->format('d-m-Y') === $request->expire_at;
                });
            }

            // Solo aplica a vendedores
            /*if ($request->status) {
                $path .= '&status=' . $request->status;
                $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
                    return !Aplicant::where([
                        'oportunity_id' => $oportunity->id,
                        'status_postulation_id' => $request->status
                    ])->get()->isEmpty();
                });
            }*/
        }

        $oportunitys = $this->paginate($oportunitys, 5, null, ['path' => 'oportunitys' . $path]);

        return view('oportunitys.myOportunitys', compact('oportunitys', 'sectors', 'ubications', 'jobType'));
    }

    public function showAll(Request $request)
    {
        /** @var Object Oportunidades registradas por otros */
        $oportunitys = Oportunity::where('status_id', 2)
                                 ->where('user_id', '<>', auth()->user()->id)
                                 ->orderByDesc('updated_at')->get();
        $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
            return ($oportunity->expire_at!==null && $oportunity->expire_at->format('d-m-Y') >= Carbon::now()) ||
                   $oportunity->expire_at===null;
        });
        $sectors = SectorOportunity::all();
        $ubications = UbicationOportunity::all();
        $jobType = JobType::all();

        $path = '';
        if ($request->_token) {
            $text = ($request->oportunitySearch!==null) ? str_replace(" ", "+", $request->oportunitySearch) : '';
            $path = '?_token=' . $request->_token .
                    '&oportunitySearch=' . $text .
                    '&jobType=' . $request->jobType .
                    '&ubication=' . $request->ubication .
                    '&sector=' . $request->sector .
                    '&expire_at=' . $request->expire_at;

            if ($request->oportunitySearch) {
                //Filtrar oportunidades por texto en búsqueda
                $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
                    $text = strtoupper($request->oportunitySearch);
                    return strpos(strtoupper($oportunity->title), $text) !== false ||
                           strpos(strtoupper($oportunity->description), $text) !== false ||
                           strpos(strtoupper($oportunity->cargo), $text) !== false ||
                           strpos(strtoupper($oportunity->functions), $text) !== false ||
                           strpos(strtoupper($oportunity->email_contact), $text) !== false ||
                           strpos(strtoupper($oportunity->web), $text) !== false ||
                           strpos(strtoupper($oportunity->jobType->description), $text) !== false ||
                           strpos(strtoupper($oportunity->ubicationOportunity->description), $text) !== false;
                });
            }
            if ((int)$request->jobType !== 0) {
                //Filtrar oportunidades por tipo de trabajo
                $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
                    return $oportunity->job_type_id === (int)$request->jobType;
                });
            }
            if ((int)$request->ubication !== 0) {
                //Filtrar oportunidades por ubication
                $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
                    return $oportunity->ubication_oportunity_id === (int)$request->ubication;
                });
            }
            if ((int)$request->sector !== 0) {
                //Filtrar oportunidades por sector
                $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
                    return strpos($oportunity->sectors, $request->sector) !== false;
                });
            }
            if ($request->expire_at) {
                //Filtrar por fecha de caducidad de la oportunidad
                $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
                    return $oportunity->expire_at!==null &&
                           $oportunity->expire_at->format('d-m-Y') >= $request->expire_at;
                });
            }

            // Solo aplica a vendedores
            /*if ($request->status) {
                $path .= '&status=' . $request->status;
                $oportunitys = $oportunitys->filter(function ($oportunity) use ($request) {
                    return !Aplicant::where([
                        'oportunity_id' => $oportunity->id,
                        'status_postulation_id' => $request->status
                    ])->get()->isEmpty();
                });
            }*/
        }

        $oportunitys = $this->paginate($oportunitys, 5, null, ['path' => 'oportunitys' . $path]);

        return view('oportunitys.oportunitys', compact('oportunitys', 'sectors', 'ubications', 'jobType'));
    }

    public function showRegistrationOportunity($oportunity = null)
    {
        $typeOportunitys = TypeOportunity::all();
        $jobTypes = JobType::all();
        $ubicationOportunitys = UbicationOportunity::all();
        $statusOportunity=StatusOportunity::all();
        $user=\Auth::user();
        $sectorsAll=SectorOportunity::all();
        $oportunity=isset($oportunity) ? Oportunity::find((int)$oportunity) : '';
        $aptitudes=Aptitud::all();


        return view(
            'oportunitys.oportunityForm',
            compact(
                'typeOportunitys',
                'jobTypes',
                'ubicationOportunitys',
                'statusOportunity',
                'sectorsAll',
                'oportunity',
                'aptitudes'
            )
        );
    }

    public function store(Request $request)
    {
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
            'amount' => 'numeric|min:0',
            'leads' => 'numeric|min:0',

        ]);

        $sectors=implode(',', $request->input('sectors'));
        $skills=implode(',', $request->input('skills'));

        if ($request->has('publicar')) {
            $estatus=2;
        } elseif ($request->has('borrador') || $request->has('previa')) {
            $estatus=1;
        } elseif ($request->has('newstatus')) {
            $estatus=$request->input('statusOportunity');
        }

        $expireAt = null;
        if ($request->expire_at) {
            list($day, $month, $year) = explode("-", $request->expire_at);
            $expireAt = $year . '-' . $month . '-' . $day;
        }

        $oportunity = Oportunity::updateOrCreate(
            [
                'id'=>$request->oportunity_id,
                'user_id' => auth()->user()->id
            ],
            [
                'title' =>  $request->title,
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
                'expite_at' => $expireAt,
                'amount' => $request->amount,
                'leads' => $request->leads,
                'id_funnel' => $request->is_funnel ? 1 : 0,
            ]
        );

        if ($request->has('previa')) {
            $id=$oportunity->id;
            return redirect()->route('oportunity', ['id' => $id]);
        } else {
            return redirect()->route('oportunity.saved');
        }
    }

    public function showOportunity($id)
    {
        $oportunity=Oportunity::find($id);
        $typeOportunitys = TypeOportunity::all();
        $jobTypes = JobType::all();
        $ubicationOportunitys = UbicationOportunity::all();
        $statusOportunity=StatusOportunity::all();
        $user=\Auth::user();
        $sectorsAll=SectorOportunity::all();
        $aptitudes=Aptitud::all();

        return view(
            'oportunitys.oportunity',
            [
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

    public function update(Request $request)
    {
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
            'amount' => 'numeric|min:0',
            'leads' => 'numeric|min:0',
        ]);

        $sectors=implode(',', $request->input('sectors'));
        $skills=implode(',', $request->input('skills'));

        if ($request->has('publicar')) {
            $estatus=2;
        } elseif ($request->has('borrador') || $request->has('previa')) {
            $estatus=1;
        } elseif ($request->has('newstatus')) {
            $estatus=$request->input('statusOportunity');
        }

        $expireAt = null;
        if ($request->expire_at) {
            list($day, $month, $year) = explode("-", $request->expire_at);
            $expireAt = $year . '-' . $month . '-' . $day;
        }

        $oportunity = Oportunity::find($request->oportunity_id);
        $oportunity->title = $request->title;
        $oportunity->job_type_id = $request->jobType;
        $oportunity->ubication_oportunity_id = $request->ubicationOportunity;
        if (isset($estatus)) {
            $oportunity->status_id = (int)$estatus;
        }
        $oportunity->description = $request->description;
        $oportunity->cargo = $request->cargo;
        $oportunity->sectors = $sectors;
        $oportunity->skills = $skills;
        $oportunity->functions = $request->functions;
        $oportunity->ubication = $request->ubication;
        $oportunity->email_contact = $request->email_contact;
        $oportunity->web = $request->web;
        $oportunity->expire_at = $expireAt;
        $oportunity->amount = $request->amount;
        $oportunity->leads = $request->leads;
        $oportunity->is_funnel = $request->is_funnel ? 1 : 0;
        $oportunity->save();

        session()->flash('message', 'Registro actualizado');

        if ($request->has('previa')) {
            $id=$oportunity->id;
            return redirect()->route('oportunity', ['id' => $id]);
        } else {
            return redirect()->route('oportunity.saved');
        }
    }

    public function getImage($filename)
    {
        $file=Storage::disk('oportunitys')->get($filename);
        return new Response($file, 200);
    }

    public function changeStatus(Oportunity $oportunity, $statusType)
    {
        $statusOportunity = StatusOportunity::where('description', str_replace("+", " ", $statusType))->first();
        if ($statusOportunity) {
            $oportunity->status_id = $statusOportunity->id;
            $oportunity->save();
            session()->flash('message', 'Oportunidad ' . $statusType);
        }
        return redirect()->route('oportunity.saved');
    }
}
