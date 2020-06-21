<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
