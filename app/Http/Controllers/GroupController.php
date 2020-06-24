<?php

namespace App\Http\Controllers;

use App\ContactGroup;
use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\GroupUser;
use App\Invitation;
use App\Notifications\NewInvitationGroup;
use Illuminate\Support\Facades\Mail;
use App\Mail\NuevaInvitacionRecibida;

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
            $name_group=$grupo->name;
            $group_id=$grupo->id;
            $user_id=User::where('email', $email)->value('id');
            $codigo_confirmacion= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20); 
            
            $invitation = Invitation::updateOrCreate(
                ['group_id' =>  $group_id,
                 'email' => $email,
                 'token'=>$codigo_confirmacion,
                 'status'=>0,
                ]
            );            
            if($user_id==null){
                Mail::to($email)->send(new NuevaInvitacionRecibida($name_group, $codigo_confirmacion));
                echo 'Usuario no registrado';
            
            }else{               
                $user_notify=User::find($user_id);
                $user_notify->notify(new NewInvitationGroup());
                echo 'correo enviado';
            }

        }
    }
}
