<?php
namespace App\Http\Controllers;

use App\ContactGroup;
use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\GroupUser;
use App\Invitation;
use App\Notifications\NewInvitationGroup;
use App\Notifications\ExitGroup;
use Illuminate\Support\Facades\Mail;
use App\Mail\NuevaInvitacionRecibida;
use App\Helpers\FormatTime;
use App\Rules\InvitationRule;
use Carbon\Carbon;

class GroupController extends Controller
{
    public function show()
    {
        $groups=Group::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->get();
        $groups_added=GroupUser::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->get();
        return view('groups.create-group', ['groups'=>$groups, 'groups_added'=>$groups_added]);
    }

    public function create()
    {
        $users=User::orderBy('name', 'desc')->get();
        // var_dump($users); die();
        return view('groups.form-group', ['users'=> $users,]);
    }

    public function edit($group_id)
    {
        $group=Group::find((int)$group_id);
        $userGroup=GroupUser::where('group_id', $group_id)->get();
        $users=User::orderBy('name', 'desc')->get();
        $invitations = $group->invitation()->get(['email', 'status']);

        return view('groups.edit-group', [
            'group' => $group, 'userGroup' => $userGroup, 'users' => $users, 'invitations' => $invitations
        ]);
    }

    public function store(Request $request)
    {
        $validation= $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $grupo = Group::updateOrCreate(
            [
                'name' =>  $request->name,
                'user_id' => auth()->user()->id
            ],
            []
        );
        $time=FormatTime::LongTimeFilter($grupo->created_at);

        if ($grupo && $request->input('email')) {
            $this->validate($request, [
                'email' => [new InvitationRule($grupo->id)]
            ]);
            $email=$request->input('email');
            $name_group=$grupo->name;
            $group_id=$grupo->id;
            $user_id=User::where('email', $email)->value('id');
            $codigo_confirmacion= substr(
                str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),
                0,
                20
            );
            $url=$codigo_confirmacion;

            $invitation = Invitation::updateOrCreate(
                ['group_id' =>  $group_id,
                 'email' => $email,
                 'token'=>$codigo_confirmacion,
                 'status'=>'pendiente',
                ]
            );

            if ($user_id==null) {
                // var_dump($name_group); die();
                Mail::to($email)->send(new NuevaInvitacionRecibida($name_group, $url));

                return redirect()->route('group.show')->with(['message'=>'Invitación enviada exitosamente']);
            } else {
                $user_notify=User::find($user_id);

                $user_notify->notify(new NewInvitationGroup($name_group, $url, $time, auth()->user()));
                return redirect()->route('group.show')->with(['message'=>'Invitación enviada exitosamente']);
            }
        } else {
            return redirect()->back()->with(['message'=>'Invitación enviada exitosamente']);
        }
    }

    public function update(Request $request)
    {
        $validation= $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $group_id=$request->input('group_id');
        $grupo=Group::find((int)$group_id);
        $grupo->name=$request->input('name');
        $grupo->update();

        if ($grupo && $request->input('email')) {
            $this->validate($request, [
                'email' => [new InvitationRule($grupo->id)]
            ]);
            $email=$request->input('email');
            $name_group=$grupo->name;
            $group_id=$grupo->id;
            $user_id=User::where('email', $email)->value('id');
            $codigo_confirmacion= substr(
                str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),
                0,
                20
            );
            $url=$codigo_confirmacion;
            $time=FormatTime::LongTimeFilter($grupo->created_at);

            $invitation = Invitation::updateOrCreate(
                ['group_id' =>  $group_id,
                 'email' => $email,
                 'token'=>$codigo_confirmacion,
                 'status'=>'pendiente',
                ]
            );

            if ($user_id==null) {
                Mail::to($email)->send(new NuevaInvitacionRecibida($name_group, $url));
                return redirect()->route('group.show')->with(['message'=>'Invitación enviada exitosamente']);
            } else {
                $user_notify=User::find($user_id);
                $user_notify->notify(new NewInvitationGroup($name_group, $url, $time, auth()->user()));
                return redirect()->route('group.show')->with(['message'=>'Invitación enviada exitosamente']);
            }
        } else {
            return redirect()->route('group.show')->with(['message'=>'Grupo modificado exitosamente']);
        }
    }

    public function confirmAceptInvitation($invitacion_id)
    {
        $group_id=Invitation::where('id', (int)$invitacion_id)->orWhere('token', $invitacion_id)->value('group_id');
        $group=Group::where('id', $group_id)->first();
        return view('groups.confirm', ['group'=> $group, 'invitacion_id'=>$invitacion_id]);
    }


    public function aceptInvitation($id_group, $id_invitacion)
    {
        $id_invitacion=(int)$id_invitacion;
        $invitacion=Invitation::where('id', (int)$id_invitacion)->orWhere('token', $id_invitacion)->first();

        $invitacion->status="aceptada";
        $invitacion->update();

        $user_id=auth()->user()->id;
        $newMenber = GroupUser::updateOrCreate(
            [
                'group_id' => $id_group,
                'user_id' => auth()->user()->id
            ],
            []
        );
        if ($newMenber) {
            //return redirect()->route('contact.list')->with(['message'=>'Grupo agregado exitosamente']);
            return redirect()->route('group.show')->with(['message'=>'Grupo agregado exitosamente']);
        }
    }


    public function cancelInvitation($id_group, $id_invitacion)
    {
        $invitacion=Invitation::find((int)$id_invitacion);
        $invitacion->status="rechazada";
        $invitacion->update();

        return redirect()->route('contact.list')->with(['message'=>'Invitación rechazada']);
    }

    /**
     * Permite eliminar un usuario de un grupo
     *
     * @method    destroy
     *
     * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
     *
     * @param     Request    $request    Objeto con la petición
     *
     * @return    object     Objeto con los datos de respuesta
     */
    public function destroy(Request $request)
    {
        $groupUser = GroupUser::where(['group_id' => $request->group_id, 'user_id' => $request->user_id])->first();

        if ($groupUser) {
            $groupUser->delete();

            if ($request->user_id === auth()->user()->id) {
                /** Usuario que se esta dando de baja de un grupo */
                $invitation=Invitation::where([
                    'group_id' => $groupUser->group_id, 'email' => auth()->user()->email
                ])->first();
                if ($invitation) {
                    $invitation->delete();
                }
                $time=FormatTime::LongTimeFilter(Carbon::now());
                $groupUser->group->user->notify(
                    new ExitGroup($groupUser->group->name, auth()->user()->name, route('group.show'), $time)
                );
                session()->flash('message', 'Se ha dado de baja en el grupo ' . $groupUser->group->name);
            } else {
                session()->flash('message', 'Usuario eliminado del grupo');
            }
        } else {
            session()->flash('message', 'El usuario no pudo ser eliminado del grupo');
        }
        return response()->json(['result' => true], 200);
    }
}
