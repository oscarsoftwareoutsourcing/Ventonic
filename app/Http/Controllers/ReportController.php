<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use stdClass;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\JobType;
use App\TypeOportunity;
use App\UbicationOportunity;
use App\Oportunity;
use App\SectorOportunity;
use App\StatusOportunity;
use App\Aptitud;
use App\Negotiation;
use App\Note;
use App\Event;
use App\Email;
use App\Document;
use App\Task;
use App\CallEvent;




class ReportController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function sales(Request $request){

        //$date_term = "7 days ago";

        $date_range = '';
        if ($request->_token) {
            $date_range = self::getDateRange($request->etiquetas);
        } else {
            $date_range = self::getDateRange("90 days ago");
        }

        $user_id=\Auth::user()->id;

        $data_process = null;
        $data_status = null;

        $data_process = DB::table('negotiations as n')
            ->select(
                'n.neg_process_id',
                'p.name as desc',
                DB::raw('COUNT(n.user_id) as qty'),
                DB::raw("FORMAT(SUM(n.amount),2, 'de_DE') as tot")
                
            )
            ->Join('negotiation_process as p', 'p.id', '=', 'n.neg_process_id' )
            ->where('n.user_id',$user_id)
            ->where('n.created_at', '>=', $date_range->from)
            ->where('n.created_at', '<=', $date_range->to)
            ->groupBy('n.user_id', 'n.neg_process_id', 'p.name')
            ->get();

        $data_status = DB::table('negotiations as n')
            ->select(
                'n.neg_status_id',
                's.status as desc',
                DB::raw('COUNT(n.user_id) as qty'),
                DB::raw("FORMAT(SUM(n.amount),2, 'de_DE') as tot")
                
            )
            ->Join('negotiation_statuses as s', 's.id', '=', 'n.neg_status_id' )
            ->where('n.user_id',$user_id)
            ->where('n.created_at', '>=', $date_range->from)
            ->where('n.created_at', '<=', $date_range->to)
            ->groupBy('n.user_id', 'n.neg_status_id', 's.status')
            ->get();

            $pro_label = null;
            $pro_qty = null;
            foreach($data_process as $process) {
                $pro_label[]= $process->desc;
                $pro_qty[] = $process->qty;
            }

            $dt_prolabel = \json_encode($pro_label);
            $dt_proqty = \json_encode($pro_qty);

            //dd($data_status);
            $pie_label = null;
            $pie_qty = null;
            foreach($data_status as $stat) {
                $pie_label[]= $stat->desc;
                $pie_qty[] = $stat->qty;
            }
        
            
            $dt_pielabel = json_encode($pie_label);
            $dt_pieqty = json_encode($pie_qty);

            //dd($dt_stat);
            
        return view('report.sales',['user_id' => $user_id,
                                    'processes' => $data_process,
                                    'totals' => $data_status,
                                    'pie_label' => $dt_pielabel,
                                    'pie_qty' => $dt_pieqty,
                                    'pro_label' => $dt_prolabel,
                                    'pro_qty' => $dt_proqty]);
    }


     public function activities (Request $request){

        //$date_term = "7 days ago";

        $date_range = '';
        if ($request->_token) {
            $date_range = self::getDateRange($request->etiquetas);
        } else {
            $date_range = self::getDateRange("90 days ago");
        }

        //dd($date_range);
        $user_id=\Auth::user()->id;


        $data_notes = Note::selectRaw('year(created_at) as year, month(created_at) as month, COUNT(*) as qty')
                        ->whereDate('created_at', '>=', $date_range->from)
                        ->whereDate('created_at', '<=', $date_range->to)
                        ->where('user_id',$user_id)
                        ->groupBy(DB::raw('year(created_at)'))
                        ->groupBy(DB::raw('month(created_at)'))->get();
        
        $data_emails = Email::selectRaw('year(created_at) as year, month(created_at) as month, COUNT(*) as qty')
                        ->whereDate('created_at', '>=', $date_range->from)
                        ->whereDate('created_at', '<=', $date_range->to)
                        ->where('from_user_id',$user_id)
                        ->groupBy(DB::raw('year(created_at)'))
                        ->groupBy(DB::raw('month(created_at)'))->get();
        
        $data_task = Task::selectRaw('year(created_at) as year, month(created_at) as month, COUNT(*) as qty')
                        ->whereDate('created_at', '>=', $date_range->from)
                        ->whereDate('created_at', '<=', $date_range->to)
                        ->where('user_id',$user_id)
                        ->groupBy(DB::raw('year(created_at)'))
                        ->groupBy(DB::raw('month(created_at)'))->get();

        $data_documents = Document::selectRaw('year(created_at) as year, month(created_at) as month, COUNT(*) as qty')
                        ->whereDate('created_at', '>=', $date_range->from)
                        ->whereDate('created_at', '<=', $date_range->to)
                        ->where('user_id',$user_id)
                        ->groupBy(DB::raw('year(created_at)'))
                        ->groupBy(DB::raw('month(created_at)'))->get();

        $data_callEvent = CallEvent::selectRaw('year(created_at) as year, month(created_at) as month, COUNT(*) as qty')
                        ->whereDate('created_at', '>=', $date_range->from)
                        ->whereDate('created_at', '<=', $date_range->to)
                        ->where('user_id',$user_id)
                        ->groupBy(DB::raw('year(created_at)'))
                        ->groupBy(DB::raw('month(created_at)'))->get();
        $data_event = Event::selectRaw('year(created_at) as year, month(created_at) as month, COUNT(*) as qty')
                        ->whereDate('created_at', '>=', $date_range->from)
                        ->whereDate('created_at', '<=', $date_range->to)
                        ->where('user_id',$user_id)
                        ->groupBy(DB::raw('year(created_at)'))
                        ->groupBy(DB::raw('month(created_at)'))->get();

        $pro_label = null;
        $pro_qty = null;

        $data[0]        = array('type'=>'Email' ,'qty' => $data_emails->sum->qty);
        $pro_label[0]   = 'Email';
        $pro_qty[0]     = $data_emails->sum->qty;
        $data[1]        = array('type'=>'Actividades' ,'qty' => $data_notes->sum->qty);
        $pro_label[1]   = 'Actividades';
        $pro_qty[1]     = $data_notes->sum->qty;
        $data[2]        = array('type'=>'Tareas' ,'qty' => $data_task->sum->qty);
        $pro_label[2]   = 'Tareas';
        $pro_qty[2]     = $data_task->sum->qty;
        $data[3]        = array('type'=>'Documentos' ,'qty' => $data_documents->sum->qty);
        $pro_label[3]   = 'Documentos';
        $pro_qty[3]     = $data_documents->sum->qty;
        $data[4]        = array('type'=>'Llamadas' ,'qty' => $data_callEvent->sum->qty);
        $pro_label[4]   = 'Llamadas';
        $pro_qty[4]     = $data_callEvent->sum->qty;
        $data[5]        = array('type'=>'Eventos' ,'qty' => $data_event->sum->qty);
        $pro_label[5]   = 'Eventos';
        $pro_qty[5]     = $data_event->sum->qty;

        $dt_prolabel = \json_encode($pro_label);
        $dt_proqty = \json_encode($pro_qty);


        //dd($data);

        return view('report.activities',['data' => $data,
                                            'pro_label' => $dt_prolabel,
                                            'pro_qty' => $dt_proqty]);

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

        //dd($date_range);
        
        return $date_range;
    }




     /* $data_emails = DB::select("SELECT YEAR(created_at), MONTH(created_at), 
                                    COUNT(*) FROM `emails` 
                                    where created_at >='". $date_range->from."' and
                                    created_at <='". $date_range->to."' and
                                    user_id = ".$user_id."
                                    GROUP BY YEAR(created_at), MONTH(created_at) 
                                    ORDER BY `MONTH(created_at)` ASC");*/

        //$collection_note = collect($data_notes);
        //$collection_email = collect($data_notes);
        //$collection_document = collect($data_notes);
        //$collection_task = collect($data_notes);
        //$collection_evetnt = collect($data_notes);
        //$collection_note = collect($data_notes);

        //$collection->dd();
        //$collection->count()
        //$data_notes->count()
        //$data_notes->sum->qty;

}
