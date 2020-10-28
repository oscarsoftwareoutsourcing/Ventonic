<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Contact;
use App\Negotiation;
use App\Event;
use App\Document;
use App\Note;
use App\Helpers\FormatTime;
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
        //validamos si esta en demo

        $date_term = "7 days ago";
        // if (auth()->user()->type === "E") {
        //$questions = $this->getQuestions();
        // return view('search-result');
        $contacts_data['all'] = self::getContacts($date_term);
        $contacts_data['new'] = self::getContacts($date_term,'1',true);
        $contacts_data['lost'] = self::getContacts($date_term, '5',true);
        // dd( $contacts_data['lost']);
        $negs['all'] = self::getNegotiations($date_term);
        $negs['in_process'] = self::getNegotiations($date_term, 3, null);
        $negs['won'] = self::getNegotiations($date_term, 1, null);
        $negs['lost'] = self::getNegotiations($date_term, 2, null, true);
        $negs['closed'] = self::getNegotiations($date_term, null, 6);
        $negs['comisiones'] = self::getNegotiationsComision($date_term, 1, 6);
        $daysCount = self::getConvDays($date_term);
        $convDaysAvg = ($negs['won']['total'] > 0) ? $daysCount / $negs['won']['total'] : 0;
        $negs['convDays'] = number_format($convDaysAvg);


        $activities = json_encode(self::getActivities($date_term));

        //dd($activities);

        if (auth()->user()->dash_demo==1) {
            return view('dashboard.index', ['contacts_data' => $contacts_data, 'negs' => $negs, 'activity' => $activities]);
        } else {
            return view('dashboard.demo', ['contacts_data' => $contacts_data, 'negs' => $negs]);  //home
        }
    }

    public function demo()
    {
        //validamos si esta en demo
        $date_term = "7 days ago";
        $contacts_data['all'] = self::getContacts($date_term);
        $contacts_data['new'] = self::getContacts($date_term,'1',true);
        $contacts_data['lost'] = self::getContacts($date_term, '5', true);
        $negs['all'] = self::getNegotiations($date_term);
        $negs['in_process'] = self::getNegotiations($date_term, 3, null);
        $negs['won'] = self::getNegotiations($date_term, 1, null);
        $negs['lost'] = self::getNegotiations($date_term, 2, null);
        $negs['closed'] = self::getNegotiations($date_term, null, 6);
        $negs['comisiones'] = self::getNegotiationsComision($date_term, 1, 6);
        $daysCount = self::getConvDays($date_term);
        $convDaysAvg = ($negs['won']['total'] > 0) ? $daysCount / $negs['won']['total'] : 0;
        $negs['convDays'] = number_format($convDaysAvg);
        return view('dashboard.demo', ['contacts_data' => $contacts_data, 'negs' => $negs]);  //home
    }

    public function midash(Request $request)
    {
        //validamos si esta en demo
        $user_id = auth()->user()->id;
        $user_up = User::where('id', $user_id)->first();

        if ($request->get('favorito')) {
            $user_up->dash_demo = 1;
            $user_up->save();
        }
        //dd($user_up);

        $date_term = "7 days ago";
        $contacts_data['all'] = self::getContacts($date_term);
        $contacts_data['new'] = self::getContacts($date_term,'1',true);
        $contacts_data['lost'] = self::getContacts($date_term, '5', true);
        $negs['all'] = self::getNegotiations($date_term, null, null);
        $negs['in_process'] = self::getNegotiations($date_term, 3, null);
        $negs['won'] = self::getNegotiations($date_term, 1, null);
        $negs['lost'] = self::getNegotiations($date_term, 2, null,true);
        $negs['closed'] = self::getNegotiations($date_term, null, 6);
        $negs['comisiones'] = self::getNegotiationsComision($date_term, 1, 6);
        $daysCount = self::getConvDays($date_term);
        $convDaysAvg = ($negs['won']['total'] > 0) ? $daysCount / $negs['won']['total'] : 0;
        $negs['convDays'] = number_format($convDaysAvg);

        $activities = self::getActivities($date_term);


        return view('dashboard.index', ['contacts_data' => $contacts_data, 'negs' => $negs, 'activity' => $activities]);  //home
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
        return response()->json(User::where('type', 'V')->get());
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
        $to = date('Y-m-d 23:59:59');
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

        //dd($date_range);

        return $date_range;
    }

    public static function getContacts($date, $type = null, $update = null)
    {
        //dd(auth()->user()->id);
        //DB::connection()->enableQueryLog();
        $date_op = 'created_at';
        if($update){
            $date_op = 'updated_at';
        }
        $date_range = self::getDateRange($date);
        $contacts = Contact::selectRaw("count(*) as total, DATE_FORMAT(".$date_op.", '%Y-%m-%d') AS day_logged")
            ->where('user_id', auth()->user()->id)
            ->where($date_op, '>=', $date_range->from)
            ->where($date_op, '<=', $date_range->to);
        if ($type>0) {
            $contacts = $contacts->where('contact_type_id', '=', $type)
            ->groupBy($date_op)
            ->orderBy('day_logged')
            ->get()->toArray();
        } else {
            $contacts = $contacts->groupBy($date_op)
            ->orderBy('day_logged')
            ->get()->toArray();
        }


        $data['total'] = array_sum(array_column($contacts, 'total'));
        $data['contacts'] = $contacts;
        $data['percent'] = round(($data['total'] / Contact::count()) * 100, 2);

        //$queries = DB::getQueryLog();
        //dd($queries);
        return $data;
    }

    public function filterDashbaord(Request $request)
    {
        $date_term = $request->date_range;
        $contacts_data['all'] = self::getContacts($date_term);
        $contacts_data['new'] = self::getContacts($date_term,'1',true);
        $contacts_data['lost'] = self::getContacts($date_term, '5',true);
        $negs['all'] = self::getNegotiations($date_term);
        $negs['in_process'] = self::getNegotiations($date_term, 3, null);
        $negs['won'] = self::getNegotiations($date_term, 1, null);
        $negs['lost'] = self::getNegotiations($date_term, 2, null, true);
        $negs['closed'] = self::getNegotiations($date_term, null, 6);
        $negs['comisiones'] = self::getNegotiationsComision($date_term, 1, 6);
        $daysCount = self::getConvDays($date_term);
        $convDaysAvg = ($negs['won']['total'] > 0) ? $daysCount / $negs['won']['total'] : 0; //$daysCount/$negs['won']['total'];
        $negs['convDays'] = number_format($convDaysAvg);

        $activities = self::getActivities($date_term);


        return json_encode(['contacts_data' => $contacts_data, 'negs' => $negs, 'activity' => $activities]);
    }

    public static function getNegotiations($date, $status_id = null, $process_id = null, $update = null)
    {
        // Status_id => process = 3, won = 1,  lost = 2, FALSE = all;

        $date_op = 'created_at';
        if($update){
            $date_op = 'updated_at';
        }

        $date_range = self::getDateRange($date);
        $user_id = auth()->user()->id;

        $negs = Negotiation::selectRaw("count(*) as total, SUM(amount) as amount, DATE_FORMAT(".$date_op.", '%Y-%m-%d') AS day_logged");
        if ($status_id) {
            $negs = $negs->where('neg_status_id', $status_id);
        }
        if ($process_id) {
            $negs = $negs->where('neg_process_id', $process_id);
        }
        $negs = $negs->where($date_op, '>=', $date_range->from)
            ->where($date_op, '<=', $date_range->to)
            ->where('user_id', '=', $user_id)
            ->groupBy($date_op)
            ->orderBy('day_logged')
            ->get()->toArray();

            //if($process_id==6 && $date=='90 days ago') {
            //    dd($negs);
            //}
        $data['total'] = array_sum(array_column($negs, 'total'));
        $data['amount'] = array_sum(array_column($negs, 'amount'));
        $data['negs'] = $negs;

         if($update){
           // dd($data);
        }
        return $data;
    }

    public static function getNegotiationsComision($date, $status_id = null, $process_id = null) {
        $date_range = self::getDateRange($date);
        $user_id = auth()->user()->id;

        //DB::connection()->enableQueryLog();

        $negs = Negotiation::selectRaw("commission_type as type ,commission_amount as amount, amount as total, DATE_FORMAT(created_at, '%Y-%m-%d') AS day_logged");
        if ($status_id) {
            $negs = $negs->where('neg_status_id', $status_id);
        }
        if ($process_id) {
            $negs = $negs->where('neg_process_id', $process_id);
        }
        $negs = $negs->where('created_at', '>=', $date_range->from)
            ->where('created_at', '<=', $date_range->to)
            ->where('user_id', '=', $user_id)
            ->get();
        //$queries = DB::getQueryLog();
        //dd($queries);
        //dd($negs);
        $comision = 0;
        if ($negs->count()) {
            foreach ($negs as $neg) {
                $type = '';
                $type = $neg->type;
                $amount = 0;
                $amount = $neg->amount;
                $total = 0;
                $total = $neg->total;
                if($type=='M') {
                    $comision +=$amount;
                } else {
                    $comision += ($amount * $total)/100;
                }
            }
        }
        //dd($comision);
        return $comision;

    }

    public static function getConvDays($date)
    {
        $date_range = self::getDateRange($date);
        //dd($date_range);
        $convDays = Negotiation::selectRaw('SUM(q1.Diff) as Diff')->fromSub(function ($query) use ($date_range) {
            $query->selectRaw("DATEDIFF( won_status_date, created_at ) AS Diff")
                ->from('negotiations')
                ->where('neg_status_id', '=', 1)
                ->where('won_status_date', '!=', null)
                ->where('created_at', '>=', $date_range->from)
                ->where('created_at', '<=', $date_range->to);
        }, 'q1')->first();


        return $convDays->Diff;
    }

    public static function getActivities($date)
    {
        $date_range = self::getDateRange($date);
        $user_id = auth()->user()->id;

        $events = Event::select('id', 'title', 'notes', 'created_at', 'start_at')
        ->where('user_id', '=', $user_id)
        ->where('created_at', '>=', $date_range->from)
        ->where('created_at', '<=', $date_range->to)
        ->orderBy('id', 'DESC')->limit(2)->get();
        $array = null;
        $i = 0;
        if ($events->count()) {
            foreach ($events as $event) {
                //dd($event);
                $data_event = [
                    'id'    => $event->id,
                    'title' => $event->title,
                    'notes' => $event->notes,
                    'date'  => FormatTime::LongTimeFilter($event->created_at),
                    'type'  => 'event',
                    'extra' => 'Nuevo evento'
                   ];
                $array[$i] = $data_event;
                $i = $i + 1;
            }
        }

        $notes = Note::select('id', 'description', 'created_at')
        ->where('user_id', '=', $user_id)
        ->where('created_at', '>=', $date_range->from)
        ->where('created_at', '<=', $date_range->to)
        ->orderBy('id', 'DESC')->limit(2)->get();

        if ($notes->count()) {
            foreach ($notes as $note) {
                //dd($event);
                $data_note = [
                    'id'    => $note->id,
                    'title' => $note->description,
                    'notes' => '',
                    'date'  => FormatTime::LongTimeFilter($note->created_at),
                    'type'  => 'note',
                    'extra' => 'Nueva nota'
                   ];
                $array[$i] = $data_note;
                $i = $i + 1;
            }
        }

        $documents = Document::select('id', 'note', 'created_at')
        ->where('user_id', '=', $user_id)
        ->where('created_at', '>=', $date_range->from)
        ->where('created_at', '<=', $date_range->to)
        ->orderBy('id', 'DESC')->limit(2)->get();

        if ($documents->count()) {
            foreach ($documents as $doc) {
                //dd($event);
                $data_doc = [
                    'id'    => $doc->id,
                    'title' => $doc->note,
                    'notes' => '',
                    'date'  => FormatTime::LongTimeFilter($doc->created_at),
                    'type'  => 'doc',
                    'extra' => 'Nuevo documento'
                   ];
                $array[$i] = $data_doc;
                $i = $i + 1;
            }
        }
        return $array;
    }
}
