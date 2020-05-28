<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
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
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return ['status' => 'success'];
    }
}
