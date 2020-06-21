<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Message;
use App\ChatRoom;
use App\ChatRoomUser;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Chat general
     *
     * @method     index
     *
     *
     * @param      Request          $request    Objeto con la petición
     *
     * @return     View             Vista
     */
    public function index(Request $request)
    {
        return view('chat');
    }

    /**
     * Chat persona a persona
     *
     * @method     peerToPeer
     *
     *
     * @param      Request          $request    Objeto con la petición
     *
     * @return     View             Vista
     */
    public function peerToPeer(Request $request)
    {
        session(['chat_with' => $request->user]);
        return redirect()->route('chat');
    }

    public function fetchMessages()
    {
        if (session('chat_room_id') !== null) {
            return Message::where('chat_room_id', session('chat_room_id'))->with('user')->get();
        }
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message,
            'chat_room_id' => session('chat_room_id') ?? null
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return ['status' => 'success'];
    }

    public function contactSeller($id)
    {
        $user = User::find($id);
        $chatRoom = ChatRoom::create([
            'type' => 'OT'
        ]);
        session(['chat_room_id' => $chatRoom->id]);
        ChatRoomUser::create([
            'chat_room_id' => $chatRoom->id,
            'user_id' => $user->id
        ]);
        ChatRoomUser::create([
            'chat_room_id' => $chatRoom->id,
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['result' => true], 200);
    }

    /**
     * Método que crea la sala de chat para contacto de usuarios
     *
     * @method    contactBy
     *
     * @author     Ing. Oscar Lobo <roscarescalando@gmail.com>
     *
     * @param     integer       $user_id        Identificador del usuario al cual contactar
     * @param     string        $type           Tipo de registro: (op)ortunidad, (ne)gocio, (co)ntactos, (ot)ros
     * @param     string        $origin_type    Modelo de origen en minúsculas y separado por guión bajo
     *                                          cuando se trate de un modelo con palabras concatenadas
     * @param     integer       $origin_id      Identificador del modelo a relacionar
     *
     * @return    Response      Redirecciona a la página del chat
     */
    public function contactBy($user_id, $type, $origin_type = null, $origin_id = null)
    {
        $user = User::find($user_id);
        $model = ($origin_type !== null) ? "App\\" . ucfirst(Str::camel($origin_type)) : null;
        $chatRoom = ChatRoom::create([
            'type' => strtoupper($type),
            'originable_type' => $model,
            'originable_id' => $origin_id
        ]);
        session(['chat_room_id' => $chatRoom->id]);
        ChatRoomUser::insert([
            [
                'chat_room_id' => $chatRoom->id, 'user_id' => $user->id,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'chat_room_id' => $chatRoom->id, 'user_id' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);

        return redirect()->route('chat');
    }

    public function getUserChatRooms()
    {
        $chatUsers = ChatRoomUser::whereHas('chatRoom')->get();

        $chatOrigins = [
            [
                'type' => 'oportunidades',
                'users' => []
            ],
            [
                'type' => 'negociaciones',
                'users' => []
            ],
            [
                'type' => 'contactos',
                'users' => []
            ],
            [
                'type' => 'otros',
                'users' => []
            ]
        ];

        $indexes = [
            'OP' => 0, 'NE' => 1, 'CO' => 2, 'OT' => 3
        ];

        $alreadyUsers = [];

        foreach ($chatUsers as $chatUser) {
            if ($chatUser->user_id !== auth()->user()->id && !in_array($chatUser->user_id, $alreadyUsers)) {
                array_push($alreadyUsers, $chatUser->user_id);
                array_push($chatOrigins[$indexes[$chatUser->chatRoom->type]]['users'], $chatUser);
            }
        }

        return response()->json(['chatOrigins' => $chatOrigins], 200);
    }
}
