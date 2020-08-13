<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use stdClass;

use App\Http\Controllers\Controller;
use App\JobType;
use App\TypeOportunity;
use App\UbicationOportunity;
use App\Oportunity;
use App\SectorOportunity;
use App\StatusOportunity;
use App\Aptitud;
use App\Negotiation;


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

        $user_id=\Auth::user()->id;

        return view('report.activities',[]);

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

}
