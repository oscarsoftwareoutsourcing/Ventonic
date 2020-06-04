<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Contact;

//use App\SellerProfile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->type === "E") {
            //$questions = $this->getQuestions();
            // return view('search-result');
            $contacts=Contact::where('user_id', auth()->user()->id)->orderByDesc('favorite')->paginate(10);
            return view('inicio-dashboard', ['contacts'=>$contacts]);

        }
        return view('home');
    }

    public function searchSeller(){
        if (auth()->user()->type === "E") {
            return view('search-result');
        }
    }

    public function search(Request $request)
    {
        $users = User::where('type', 'V')->get();
        $questions = $this->getQuestions();
        $search_input = $request->search;

        if ($users && $request->search) {
            $users = $users->filter(function ($user) use ($request) {
                foreach (['name', 'last_name', 'email'] as $field) {
                    $needle = $user->$field;
                    if (stripos($needle, $request->search) !== false) {
                        return $user;
                    }
                }
            });
        }

        return view('search-result', compact('users', 'questions', 'search_input'));
    }

    public function getQuestions()
    {
        return response()->json(
            Question::where(['option_type' => 'V', 'status' => true])->orderBy('priority')->get()
        );
    }

    public function getSurveys()
    {
        return response()->json(
            Question::where(['option_type' => 'V', 'status' => true])->orderBy('priority')->get()
        );
    }

    public function getUsers($take = 20)
    {
        return response()->json(User::where('type', 'V')->take($take)->get());
    }

    public function filterSearch(Request $request)
    {
        $users = User::seller();

        if ($users) {
            if ($request->status) {
                $users = $users->statusConnected();
            }

            if ($request->statusDisconnected) {
                $users = $users->statusDisconnected();
            }

            if ($request->search) {
                $users = $users->byName($request->search)->byLastName($request->search)->byEmail($request->search);
            }

            if ($request->filters) {
                $users = $users->byAnswered($request->filters);
            }
        }

        return response()->json($users->get());
    }
}
