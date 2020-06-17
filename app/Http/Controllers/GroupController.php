<?php

namespace App\Http\Controllers;

use App\ContactGroup;
use Illuminate\Http\Request;
use App\Group;
use App\User;

class GroupController extends Controller
{
    public function show(){
        $groups=Group::where('user_id', auth()->user()->id)->get();
        return view('groups.create-group', ['groups'=>$groups]);
    }

    public function create(){
        $users=User::orderBy('name','desc')->get();
        // var_dump($users); die();
        return view('groups.form-group', ['users'=> $users]);
    }
}
