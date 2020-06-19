<?php

namespace App\Http\Controllers;

use App\ContactGroup;
use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\GroupUser;

class GroupController extends Controller
{
    public function show(){
        $groups=Group::where('user_id', auth()->user()->id)->get();
        return view('groups.create-group', ['groups'=>$groups]);
    }

    public function create(){
        $users=User::orderBy('name','desc')->get();
        // var_dump($users); die();
        return view('groups.form-group', ['users'=> $users,]);
    }

    public function edit($group_id){
        $group=Group::find((int)$group_id);
        $userGroup=GroupUser::where('group_id', $group_id)->get();
        $users=User::orderBy('name','desc')->get();
        return view('groups.edit-group', ['group'=> $group, 'userGroup'=>$userGroup, 'users'=>$users ]);
    }

    public function store(Request $request){
        $validation= $request->validate([
            'name' => 'required|string|max:255'
        ]);


        $grupo = Group::updateOrCreate(
            ['name' =>  $request->name,
             'user_id' => auth()->user()->id
            ]
        );

        if($grupo && $request->input('email')){
            $email=$request->input('email');
            var_dump($email); die();
            return 'Hola';
    
        }
    }
}
