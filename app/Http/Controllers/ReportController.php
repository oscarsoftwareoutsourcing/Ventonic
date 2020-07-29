<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

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

    public function sales(){
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
            ->groupBy('n.user_id', 'n.neg_process_id', 'p.name')
            ->get();

        $data_status = DB::table('negotiations as n')
            ->select(
                'n.neg_status_id',
                's.status as desc',
                DB::raw('COUNT(n.user_id) as qty'),
                DB::raw('round(SUM(n.amount),2) as tot')
                
            )
            ->Join('negotiation_statuses as s', 's.id', '=', 'n.neg_status_id' )
            ->where('n.user_id',$user_id)
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
}
