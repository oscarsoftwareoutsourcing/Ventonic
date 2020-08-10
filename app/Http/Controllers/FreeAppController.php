<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Widget;
use App\Apps;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Str;

class FreeAppController extends Controller
{
    public function index(){

        $Widget = Widget::all();
        $callme = Apps::find(1);

        //dd($callme);
        return view('free_apps.index',['widgets'=>$Widget, 'callme'=>$callme]);
        
    }

    public function validatePin(Request $request){

        $pin = $request->pin;
        $found = User::firstWhere('uuid',$pin);
        if($found){
            return response()->json(['found'=>'1'], 200);
        }else{
            return response()->json(['found'=>'0'], 200);
        }
    }

    public function apps(){
        //$type = 

        $user_type = Auth::user()->type;

        $App = Apps::where('type_user', $user_type)->get();

        return view ('apps.index', ['apps' =>$App]);

    }
}
