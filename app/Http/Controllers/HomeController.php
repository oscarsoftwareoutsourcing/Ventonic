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
        $date_term = "7 days ago";

        // if (auth()->user()->type === "E") {
        //$questions = $this->getQuestions();
        // return view('search-result');
        $contacts_data['all'] = self::getContacts($date_term);
        $contacts_data['new'] = self::getContacts($date_term, 'Cliente');
        $contacts_data['lost'] = self::getContacts($date_term, 'Cliente Perdido');
        $negs['all'] = self::getNegotiations($date_term);
        $negs['in_process'] = self::getNegotiations($date_term, 3);
        $negs['won'] = self::getNegotiations($date_term, 1);
        $negs['lost'] = self::getNegotiations($date_term, 2);
        $negs['closed'] = self::getNegotiations($date_term, null, 6);
        $daysCount = self::getConvDays($date_term);
        $convDaysAvg = ($negs['won']['total'] > 0) ? $daysCount / $negs['won']['total'] : 0;
        $negs['convDays'] = number_format($convDaysAvg);

        return view('dashboard.index', ['contacts_data' => $contacts_data, 'negs' => $negs]);
        // }
        // return view('dashboard.index');  //home
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

        //($date_range);

        return $date_range;
    }

    public static function getContacts($date, $type = null)
    {
        $date_range = self::getDateRange($date);
        $contacts = Contact::selectRaw("count(*) as total, DATE_FORMAT(created_at, '%Y-%m-%d') AS day_logged")
            ->where('user_id', auth()->user()->id)
            ->where('created_at', '>=', $date_range->from)
            ->where('created_at', '<=', $date_range->to);
        if ($type) {
            $contacts = $contacts->where('contact_type_id', $type);
        }
        $contacts = $contacts->groupBy('created_at')
            ->orderBy('day_logged')
            ->get()->toArray();

        $data['total'] = array_sum(array_column($contacts, 'total'));
        $data['contacts'] = $contacts;
        $data['percent'] = round(($data['total'] / Contact::count()) * 100, 2);
        return $data;
    }

    public function filterDashbaord(Request $request)
    {
        $date_term = $request->date_range;
        $contacts_data['all'] = self::getContacts($date_term);
        $contacts_data['new'] = self::getContacts($date_term, 'Cliente');
        $contacts_data['lost'] = self::getContacts($date_term, 'Cliente Perdido');
        $negs['all'] = self::getNegotiations($date_term);
        $negs['in_process'] = self::getNegotiations($date_term, 3);
        $negs['won'] = self::getNegotiations($date_term, 1);
        $negs['lost'] = self::getNegotiations($date_term, 2);
        $negs['closed'] = self::getNegotiations($date_term, null, 6);
        $daysCount = self::getConvDays($date_term);
        $convDaysAvg = ($negs['won']['total'] > 0) ? $daysCount / $negs['won']['total'] : 0; //$daysCount/$negs['won']['total'];
        $negs['convDays'] = number_format($convDaysAvg);

        return json_encode(['contacts_data' => $contacts_data, 'negs' => $negs]);
    }

    public static function getNegotiations($date, $status_id = null, $process_id = null)
    {


        // Status_id => process = 3, won = 1,  lost = 2, FALSE = all;
        $date_range = self::getDateRange($date);

        $negs = Negotiation::selectRaw("count(*) as total, SUM(amount) as amount, DATE_FORMAT(created_at, '%Y-%m-%d') AS day_logged");
        if ($status_id) {
            $negs = $negs->where('neg_status_id', $status_id);
        }
        if ($process_id) {
            $negs = $negs->where('neg_process_id', $process_id);
        }
        $negs = $negs->where('created_at', '>=', $date_range->from)
            ->where('created_at', '<=', $date_range->to)
            ->groupBy('created_at')
            ->orderBy('day_logged')
            ->get()->toArray();

        $data['total'] = array_sum(array_column($negs, 'total'));
        $data['amount'] = array_sum(array_column($negs, 'amount'));
        $data['negs'] = $negs;

        return $data;
    }

    public static function getConvDays($date)
    {

        $date_range = self::getDateRange($date);
        //dd($date_range);
        $convDays = Negotiation::selectRaw('SUM(q1.Diff) as Diff')->fromSub(function ($query) use ($date_range) {
            $query->selectRaw("DATEDIFF( won_status_date, created_at ) AS Diff")
                ->from('negotiations')
                ->where('neg_status_id', '=', 1)
                ->where('won_status_date', '!=', NULL)
                ->where('created_at', '>=', $date_range->from)
                ->where('created_at', '<=', $date_range->to);
        }, 'q1')->first();


        return $convDays->Diff;
    }
}
