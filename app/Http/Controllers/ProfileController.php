<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use App\Notifications\ProfileCompleted;
use App\Notifications\ProfileIncompleted;
use App\Repositories\UploadRepository;
use App\SellerAnsweredSurvey;
use App\CompanyAnsweredSurvey;
use App\CompanyProfile;
use App\SellerProfile;
use App\Question;
use App\User;

class ProfileController extends Controller
{
    public $type;
    public $status;
    public $phone_code;
    public $profile;
    public $country_flag;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getStatus();
        $this->setPhoneCode();
        $type = $this->type;
        $status = $this->status;
        $phone_code = $this->phone_code;
        $profile = $this->profile;
        $country_flag = $this->country_flag;

        $questions = Question::where(['option_type' => $type, 'status' => true])->orderBy('priority')->get();

        return view('auth.profile', compact('type', 'status', 'phone_code', 'profile', 'questions', 'country_flag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UploadRepository $up)
    {
        $answered = [];
        if ($request->question) {
            foreach ($request->question as $q) {
                list($question_id, $option_index) = explode("_", $q);
                $question_id = (strpos($question_id, '_') !== false)
                               ? explode("_", $question_id)[0] : $question_id;
                array_push($answered, [
                    'question_id' => $question_id,
                    'option_index' => $option_index
                ]);
            }
        }

        if ($this->getType() === 'E') {
            $this->validate($request, [
                'country' => ['required']
            ]);

            if ($request->file('photo')) {
                $this->validate($request, [
                    'photo' => [
                        'dimensions:min_width=100,min_height=100,max_width=800,max_height=800',
                        'mimes:jpeg,jpg,png,svg', 'file', 'max:2048'
                    ]
                ]);
                if ($up->upload($request->file('photo'), 'files')) {
                    $photo = $up->getStored();
                }
            }

            $profile = CompanyProfile::updateOrCreate(
                ['user_id' => auth()->user()->id],
                [
                    'country' => $request->country,
                    'dni_rif' => $request->dni_rif ?? null,
                    'status' => $request->status ?? 0,
                    'photo' => $photo ?? null,
                    'answered' => (!empty($answered)) ? json_encode($answered) : null
                ]
            );
        } else {
            $this->validate($request, [
                'phone_mobil_country' => ['required'],
                'phone_mobil' => ['required', 'min:9'],
                //'phone_home' => ['min:10'],
                'photo' => [
                    'dimensions:min_width=100,min_height=100,max_width=800,max_height=800',
                    'mimes:jpeg,jpg,png,svg', 'file', 'max:2048'
                ],
                'video' => [
                    'mimetypes:video/avi,video/mpeg,video/mp4,video/x-ms-wmv,video/x-msvideo',
                    'file', 'max:2048'
                ],
                'question' => ['array']
            ]);

            if ($request->file('photo')) {
                if ($up->upload($request->file('photo'), 'files')) {
                    $photo = $up->getStored();
                }
            }
            if ($request->file('video')) {
                if ($up->upload($request->file('video'), 'files')) {
                    $video = $up->getStored();
                }
            }

            if (!is_null(auth()->user()->sellerProfile)) {
                $photo = $photo ?? auth()->user()->sellerProfile->photo;
                $video = $video ?? auth()->user()->sellerProfile->video;
            }

            $profile = SellerProfile::updateOrCreate(
                ['user_id' => auth()->user()->id],
                [
                    'phone_mobil_country' => $request->phone_mobil_country,
                    'phone_mobil' => $request->phone_mobil,
                    'phone_home_country' => $request->phone_home_country ?? null,
                    'phone_home' => $request->phone_home ?? null,
                    'photo' => $photo ?? null,
                    'video' => $video ?? null,
                    'linkedin' => $request->linkedin ?? null,
                    'status' => $request->status ?? 0,
                    'answered' => (!empty($answered)) ? json_encode($answered) : null
                ]
            );
        }

        /** actualiza el estatus del perfil */
        $profile->status = $this->getStatus();
        $profile->save();

        if ($answered) {
            $answeredSurveys = (($this->getType() === 'V'))
                               ? SellerAnsweredSurvey::where('user_id', auth()->user()->id)->get()
                               : CompanyAnsweredSurvey::where('user_id', auth()->user()->id)->get();
            if ($answeredSurveys) {
                foreach ($answeredSurveys as $ans) {
                    $ans->delete();
                }
            }
            foreach ($answered as $ans) {
                if ($this->getType() === 'V') {
                    SellerAnsweredSurvey::create(
                        [
                            'option_index' => (int)$ans['option_index'],
                            'question_id' => (int)$ans['question_id'],
                            'user_id' => auth()->user()->id
                        ]
                    );
                } else {
                    CompanyAnsweredSurvey::create(
                        [
                            'option_index' => (int)$ans['option_index'],
                            'question_id' => (int)$ans['question_id'],
                            'user_id' => auth()->user()->id
                        ]
                    );
                }
            }
        }

        if (!$profile->notified) {
            if ($profile->status >= 100) {
                auth()->user()->notify(new ProfileCompleted());
                $profile->notified = true;
                $profile->save();
            } elseif ($profile->status < 100) {
                $status = $profile->status;
                auth()->user()->notify(new ProfileIncompleted($status));
            }
        }

        $request->session()->flash('status', 'Datos almacenados con éxito');

        if ($this->getType() === 'E' && $profile->status >= 100) {
            return redirect()->route('search.init');
        }

        return redirect()->route('perfil.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy($profile)
    {
        //
    }

    public function getType()
    {
        return auth()->user()->type;
    }

    public function setPhoneCode()
    {
        $isoCode = geoip(request()->ip())->iso_code;
        $country = Countries::where('cca2', $isoCode)->first();
        $this->country_flag = $country->flag->flag_icon;
        $this->phone_code = config('geoip.phone_codes')[$isoCode] ?? '';
    }

    public function getStatus()
    {
        $type = $this->getType();
        $user = User::find(auth()->user()->id);
        $profile = ($type==='E') ? $user->companyProfile : $user->sellerProfile;
        $status = 0;

        if (!is_null($profile)) {
            $questions = Question::where(['option_type' => $type, 'status' => true])->get();
            $totalToAnswer = $questions->count();
            $statusAnswered = 0;

            if (!is_null($profile->answered)) {
                $question_id = '';
                $count = 0;
                foreach (json_decode($profile->answered) as $ans) {
                    if ($question_id !== $ans->question_id) {
                        $question_id = $ans->question_id;
                        $count++;
                    }
                }
                $statusAnswered = $count * 100 / $totalToAnswer;
            }

            if ($type === 'E') {
                //calcular perfil de la empresa
                $status += ($profile->country) ? 25 : 0;
                $status += ($profile->dni_rif) ? 25 : 0;
                $status += ($profile->photo) ? 25 : 0;
                $status += ($profile->answered) ? ($statusAnswered * 25 / 100) : 0;
            } else {
                //calcular perfil de la compañía
                $status += ($profile->phone_mobil_country) ? 12.5 : 0;
                $status += ($profile->phone_mobil) ? 12.5 : 0;
                $status += ($profile->phone_home_country) ? 12.5 : 0;
                $status += ($profile->phone_home) ? 12.5 : 0;
                $status += ($profile->photo) ? 12.5 : 0;
                $status += ($profile->video) ? 12.5 : 0;
                $status += ($profile->linkedin) ? 12.5 : 0;
                $status += ($profile->answered) ? ($statusAnswered * 12.5 / 100) : 0;
            }
        }

        $this->type = $type;
        $this->status = $status;
        $this->profile = $profile;

        return $this->status;
    }
}
