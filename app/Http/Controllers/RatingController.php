<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;
use App\User;
use App\Notifications\RatingNotification;

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
            //$user = User::where('email', $contact)->first();
            $contact = 'empresa1@ventonic.com';
            $user = User::where('email', $contact)->first();

            if ($user) {
                $user->notify(new RatingNotification(auth()->user(), $contact));
            }
        }

        return response()->json(['result' => true], 200);
    }

    public function createRate(Request $request, User $user, $from)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        return view('assessment.index', compact('user', 'from'));
    }

    public function storeRate(Request $request)
    {
        Rating::create([
            'from_rate_email' => $request->from_rate_email,
            'comment' => $request->comment,
            'score' => $request->rating_score,
            'user_id' => $request->user_id
        ]);
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
        $ratings = ($request->take) ? $user->ratings()->take($request->take)->get() : $user->ratings;
        return response()->json(['result' => true, 'ratings' => $ratings, 'allRatings' => $user->ratings], 200);
    }
}
