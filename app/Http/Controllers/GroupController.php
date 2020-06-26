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
        $groups=Group::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->get();
        $groups_added=GroupUser::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->get();
        return view('groups.create-group', ['groups'=>$groups, 'groups_added'=>$groups_added]);
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
            $url=$codigo_confirmacion;

            $invitation = Invitation::updateOrCreate(
                ['group_id' =>  $group_id,
                 'email' => $email,
                 'token'=>$codigo_confirmacion,
                 'status'=>'pendiente',
                ]
            ); 
           
            if($user_id==null){
                // var_dump($name_group); die();
                Mail::to($email)->send(new NuevaInvitacionRecibida($name_group, $url));

                return redirect()->route('group.show')
                                    ->with(['message'=>'Invitación enviada exitosamente']);
            
            }else{               
                $user_notify=User::find($user_id);
                $user_notify->notify(new NewInvitationGroup($name_group, $url));
                return redirect()->route('group.show')
                                    ->with(['message'=>'Invitación enviada exitosamente']);
            }

        }else{
            return redirect()->back()->with(['message'=>'Invitación enviada exitosamente']);
        }
    }
    
    public function update(Request $request){
        $validation= $request->validate([
            'name' => 'required|string|max:255'
        ]);
        
        $group_id=$request->input('group_id');
        $grupo=Group::find((int)$group_id);
        $grupo->name=$request->input('name');
        $grupo->update();

        if($grupo && $request->input('email')){
            $email=$request->input('email');
            $name_group=$grupo->name;
            $group_id=$grupo->id;
            $user_id=User::where('email', $email)->value('id');
            $codigo_confirmacion= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20); 
            $url=$codigo_confirmacion;

            $invitation = Invitation::updateOrCreate(
                ['group_id' =>  $group_id,
                 'email' => $email,
                 'token'=>$codigo_confirmacion,
                 'status'=>'pendiente',
                ]
            ); 
           
            if($user_id==null){
                Mail::to($email)->send(new NuevaInvitacionRecibida($name_group, $url));
                return redirect()->route('group.show')
                                    ->with(['message'=>'Invitación enviada exitosamente']);
            
            }else{               
                $user_notify=User::find($user_id);
                $user_notify->notify(new NewInvitationGroup($name_group, $url));
                return redirect()->route('group.show')
                                    ->with(['message'=>'Invitación enviada exitosamente']);
            }

        }else{
            return redirect()->route('group.show')->with(['message'=>'Grupo modificado exitosamente']);
        }
    }

    public function confirmAceptInvitation($invitacion_id){
        $group_id=Invitation::where('id',(int)$invitacion_id)->value('group_id');
        $group=Group::where('id',$group_id)->first();
        return view('groups.confirm',['group'=> $group, 'invitacion_id'=>$invitacion_id]);
    }


    public function aceptInvitation($id_group, $id_invitacion){
        $id_invitacion=(int)$id_invitacion;
        $invitacion=Invitation::find($id_invitacion);

        $invitacion->status="aceptada";
        $invitacion->update();

        $user_id=auth()->user()->id;
        $newMenber = GroupUser::updateOrCreate(
            ['group_id' => $id_group,
             'user_id' => auth()->user()->id
            ]
        );
        if($newMenber){
            return redirect()->route('contact.list')
                             ->with(['message'=>'Grupo agregado exitosamente']);
        }
    }

    
    public function cancelInvitation($id_group, $id_invitacion){
        $invitacion=Invitation::find((int)$id_invitacion);
        $invitacion->status="rechazada";
        $invitacion->update();
        
         return redirect()->route('contact.list')
            ->with(['message'=>'Invitación rechazada']);
    }


}
