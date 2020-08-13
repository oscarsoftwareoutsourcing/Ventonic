<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Contact;
use App\Negotiation;
use stdClass;
use DB;

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
            //return view('inicio-dashboard', ['contacts'=>$contacts]);
            return view('dashboard.index', ['contacts'=>$contacts]);

        }
        return view('dashboard.index');  //home
    }

    public function searchSeller()
    {
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
                $users = $users->byName($request->search)->orByLastName($request->search)->orByEmail($request->search);
            }

            if ($request->filters) {
                $users = $users->byAnswered($request->filters);
            }
        }
        
        $users = $users->seller();
        
        return response()->json($users->get());
    }

    public static function getDateRange($date)
    {
        //dd($date);
        $to = date('Y-m-d h:i:s');
        if ($date == 'this month') {
            $date = 'first day of this month';
        } elseif ($date == 'this year') {
            $date = 'first day of january this year';
        } elseif ($date == 'last year') {
            $date = 'last year January 1st';
            $to =  date("Y-m-d 23:59:59", strtotime("last year December 31st"));
        }
        $from = date("Y-m-d 00:00:00", strtotime($date));
        $date_range = new stdClass;
        $date_range->to = $to;
        $date_range->from = $from;

        dd($date_range);
        
        return $date_range;
    }
}
