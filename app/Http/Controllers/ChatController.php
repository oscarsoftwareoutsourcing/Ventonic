<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\User;
use App\Message;
use App\ChatRoom;
use App\ChatRoomUser;
use App\Events\MessageSent;
use App\Helpers\FormatTime;
use App\Notifications\ChatRoom as ChatRoomNotify;

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

    /**
     * Establece la sala de chat
     *
     * @method    setChatRoom
     *
     *
     * @param     integer         $id         Identificador de la sala de chat
     * @param     integer         $user_id    Identificador del usuario con el cual establecer conversación
     */
    public function setChatRoom($id, $user_id)
    {
        $user = User::find($user_id);
        $messages = $user->messages()->get();
        foreach ($messages as $msg) {
            $msg->unreaded = false;
            $msg->save();
        }
        /** @var object consulta el registro recién creado con la relación correspondiente a los usuarios */
        $userChatRoom = ChatRoomUser::with(['user'])->where([
            'chat_room_id' => $id, 'user_id' => $user_id
        ])->first();
        session(['chat_room_id' => $id, 'chat_room_user' => $userChatRoom]);
        return response()->json(['result' => true, 'userChat' => $user], 200);
    }

    /**
     * Obtiene los mensaje de un usuario
     *
     * @method    fetchMessages
     *
     * @return    object           Devuelve un objeto con los mensajes de un usuario
     */
    public function fetchMessages()
    {
        if (session('chat_room_id') !== null) {
            $chatRoomId = (int)session('chat_room_id');
            return Message::where('chat_room_id', $chatRoomId)->with('user')->get();
        }
        return Message::with('user')->get();
    }

    /**
     * Permite crear y enviar mensajes de chat
     *
     * @method    sendMessage
     *
     *
     * @param     Request        $request    Objeto con la petición solicitada
     *
     * @return    JSONResponse         Devuelve un objeto con el resultado de la petición
     */
    public function sendMessage(Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message,
            'chat_room_id' => session('chat_room_id') ?? null
        ]);

        if (session('chat_room_id') !== null) {
            $now = Carbon::now();
            ChatRoomUser::where(
                'chat_room_id',
                session('chat_room_id')
            )->update(['updated_at' => $now]);
            $room = ChatRoom::find(session('chat_room_id'));
            $room->updated_at = $now;
            $room->save();
            $time=FormatTime::LongTimeFilter($message->created_at);

            $chatRoomUsers = ChatRoomUser::where('chat_room_id', session('chat_room_id'))->where(
                'user_id',
                '<>',
                auth()->user()->id
            )->get();

            /** Envía notificaciones a todos los usuarios a los cuales se les envía un mensaje en una sala de chat */
            foreach ($chatRoomUsers as $chatRoomUser) {
                if ($chatRoomUser->user_id !== auth()->user()->id) {
                    $user = User::find($chatRoomUser->user_id);
                    $user->notify(
                        new ChatRoomNotify(auth()->user(), $request->message, session('chat_room_id'), $time)
                    );
                }
            }
        }

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return ['status' => 'success'];
    }

    /**
     * Crea la sala de chat bajo la cual se contacta a un vendedor
     *
     * @method    contactSeller
     *
     *
     * @param     integer           $id    Identificador del usuario a contactar
     *
     * @return    JSONResponse             Objeto con la respuesta
     */
    public function contactSeller($id)
    {
        $user = User::find($id);

        Message::whereIn('user_id', []);
        $messages = Message::whereIn(
            'user_id',
            [$user->id, auth()->user()->id]
        )->groupBy('chat_room_id')->first('chat_room_id');

        if ($messages) {
            $chatRoom = ChatRoom::find($messages->chat_room_id);
            $userChatRoom = ChatRoomUser::where(['chat_room_id' => $chatRoom->id, 'user_id' => $user->id])->first();
        } else {
            $chatRoom = ChatRoom::create([
                'type' => 'OT'
            ]);
            $userChatRoom = ChatRoomUser::create([
                'chat_room_id' => $chatRoom->id,
                'user_id' => $user->id
            ], []);
        }
        /** @var object consulta el registro recién creado con la relación correspondiente a los usuarios */
        $userChatRoom = ChatRoomUser::with(['user'])->find($userChatRoom->id);
        session(['chat_room_id' => $chatRoom->id, 'chat_room_user' => $userChatRoom]);

        if (!$messages) {
            ChatRoomUser::create([
                'chat_room_id' => $chatRoom->id,
                'user_id' => auth()->user()->id
            ]);
        }

        return response()->json(['result' => true], 200);
    }

    /**
     * Método que crea la sala de chat para contacto de usuarios
     *
     * @method    contactBy
     *
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

        /** @var object consulta el registro recién creado con la relación correspondiente a los usuarios */
        $userChatRoom = ChatRoomUser::with(['user'])->where([
            'chat_room_id' => $chatRoom->id, 'user_id' => $user->id
        ])->first();
        session(['chat_room_id' => $chatRoom->id, 'chat_room_user' => $userChatRoom]);

        return redirect()->route('chat');
    }

    /**
     * Obtiene los usuarios de chat del usuario autenticado
     *
     * @method    getUserChatRooms
     *
     *
     * @return    JSONResponse              Objeto con un listado de usuario en el chat
     */
    public function getUserChatRooms()
    {
        $chatOrigins = $this->getChatOrigins();
        return response()->json(['chatOrigins' => $chatOrigins], 200);
    }

    public function filterUserChatRooms(Request $request)
    {
        $filterText = $request->filter;
        $chatOrigins = $this->getChatOrigins($filterText);
        return response()->json(['chatOrigins' => $chatOrigins], 200);
    }

    public function getChatOrigins($filter = null)
    {
        /*if ($filter !== null) {
            $filter = explode(" ", $filter);
        }*/
        $userId = auth()->user()->id;

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

        $user = User::find($userId);

        foreach ($user->chatRooms as $chatRoom) {
            /** @var object Datos de conversaciones en chats ordenados descendentemente, mas recientes de primero */
            $chatUsers = ChatRoomUser::where('chat_room_id', $chatRoom->chat_room_id)->where(
                'user_id',
                '<>',
                $userId
            )->latest()->get();

            foreach ($chatUsers as $chatUser) {
                /*if (
                    $filter !== null &&
                    count($filter) > 0 &&
                    $this->strposArr($chatUser->user->name, $filter) === false &&
                    $this->strposArr($chatUser->user->last_name, $filter) === false &&
                    $this->strposArr($chatUser->user->email, $filter) === false
                ) {*/
                if (
                    $filter !== null &&
                    !empty($filter) &&
                    strpos(strtoupper($chatUser->user->name), strtoupper($filter)) === false &&
                    strpos(strtoupper($chatUser->user->last_name), strtoupper($filter)) === false &&
                    strpos(strtoupper($chatUser->user->email), strtoupper($filter)) === false
                ) {
                    /** continúa a la siguiente iteración si existe un filtro y no existe en el registro */
                    continue;
                }

                if (!in_array($chatUser->user_id, $alreadyUsers)) {
                    array_push($alreadyUsers, $chatUser->user_id);
                    array_push($chatOrigins[$indexes[$chatUser->chatRoom->type]]['users'], $chatUser);
                }
            }
        }

        return $chatOrigins;
    }

    public function destroyChatRoom($id)
    {
        $chatRoom = ChatRoom::find($id);
        $chatRoom->delete();
        session()->forget(['chat_room_id', 'chat_room_user']);
        return response()->json(['result' => true], 200);
    }


    /*public function strposArr($haystack, $needle)
    {
        if (!is_array($needle)) {
            $needle = [$needle];
        }
        foreach ($needle as $what) {
            if (strpos(strtoupper($haystack), strtoupper($what)) !== false) {
                return true;
            }
        }
        return false;
    }*/
}
