<?php

namespace App\Http\Controllers;

use App\ContactGroup;
use Illuminate\Http\Request;
use App\Group;

class GroupController extends Controller
{
    public function show(){
        $groups=Group::where('user_id', auth()->user()->id)->get();
        return view('groups.create-group', ['groups'=>$groups]);
    }
}
