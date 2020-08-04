<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Widget;

class FreeAppController extends Controller
{
    public function index(){

        $Widget = Widget::all();
        return view('free_apps.index',['widgets'=>$Widget]);
        
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
}
