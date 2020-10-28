<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;
use App\User;
use App\Notifications\RatingNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\RateRequestMail;
use Illuminate\Support\Facades\URL;
use App\CompanyProfile;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }

    public function getSellerRating(Request $request, User $user)
    {
        $score = 0;
        $sumScore = 0;
        $count = 0;

        foreach ($user->ratings as $rating) {
            $sumScore += $rating->score;
            $count++;
        }

        if ($count > 0) {
            $score = $sumScore / $count;
        }

        return response()->json(['result' => true, 'score' => $score], 200);
    }

    public function hasRatings(Request $request, User $user)
    {
        return response()->json(['result' => true, 'ratings' => $user->ratings], 200);
    }

    public function sendRequest(Request $request)
    {
        $this->validate($request, [
            'contacts' => ['required']
        ]);

        foreach ($request->contacts as $contact) {
            $user = User::where('email', $contact)->first();

            if ($user !== null) {
                $user->notify(new RatingNotification(auth()->user(), $contact));
            } else {
                $subject = 'Valora a ' . auth()->user()->name;
                $url = URL::signedRoute('valorar', ['user' => auth()->user()->id, 'from' => $contact]);
                $urlText = "Valorar";
                $msg = '<p>Deja un comentario de tu experiencia. Valora la profesionalidad, amabilidad,
                        disponibilidad del vendedor con el que has trabajado, así como cualquier otro
                        aspecto que quieras compartir para que el resto de Empresas que accedan a su
                        perfil puedan conocer.</p>
                        <p>Valora tú experiencia en Ventonic con ' . auth()->user()->name . '</p>';
                $full_name = auth()->user()->name . (auth()->user()->last_name !== null)
                                                    ? (' ' . auth()->user()->last_name) : '';
                Mail::to($contact)->send(new RateRequestMail($subject, $url, $urlText, $msg, $full_name));
            }
        }

        return response()->json(['result' => true], 200);
    }

    public function createRate(Request $request, User $user, $from)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $user_empre = User::where('email', $from)->first();
        //dd($user);
        //if ($user->type == "E") {
        if ($user_empre) {
            if ($user_empre->type == "E") {
                $empre_profile = CompanyProfile::where('user_id', $user_empre->id)->first();
                if ($empre_profile->dni_rif == null) {
                    $request->session()->flash('status', 'Es necesario rellenar el campo "N.I.F." en la sección "Mi perfil" para poder realizar valoraciones a vendedores');
                    return redirect()->route('perfil.index');
                }
            } else {
                $request->session()->flash('status', 'Solo las empresas pueden realizar valoraciones a los vendedores');
                return redirect()->route('perfil.index');
            }
        } else {
            abort(401);
        }

        return view('assessment.index', compact('user', 'from'));
    }

    public function storeRate(Request $request)
    {
        //valido si existe la votacion
        $isRating = Rating::where('from_rate_email', $request->from_rate_email)
                        ->where('user_id', $request->user_id)->get();


        if ($isRating->count()) {
            //dd($isRating);
        } else {
            Rating::create([
            'from_rate_email' => $request->from_rate_email,
            'comment' => $request->comment,
            'score' => $request->rating_score,
            'user_id' => $request->user_id
            ]);
        }


        $redirectUrl = route('login', ['type' => 'empresa']);
        if (auth()->check()) {
            $redirectUrl = route('home');
        }
        return response()->json(['result' => true, 'redirectUrl' => $redirectUrl], 200);
    }

    public function alreadyRate(Request $request)
    {
        $rating = Rating::where([
            'from_rate_email' => $request->from_rate_email, 'user_id' => $request->user_id
        ])->first();

        return response()->json(['rating' => ($rating!==null)], 200);
    }

    public function getRatings(Request $request)
    {
        $user = User::find($request->user_id);
        //$ratings = ($request->take) ? $user->ratings()->take($request->take)->get() : $user->ratings;
        $ratings = $user->ratings()->orderBy('id', 'desc')->get();
        return response()->json(['result' => true, 'ratings' => $ratings], 200);
    }
}
