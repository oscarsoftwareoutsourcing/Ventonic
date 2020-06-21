<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat', function ($user) {
    return $user;
});

Broadcast::channel('chatroom.{id}', function ($user, $id) {
    //$chatRoom = \App\ChatRoom::find($id);
    //return !\App\ChatRoomUser::where('chat_room_id', $id)->get()->isEmpty();
    //return !\App\ChatRoomUser::where(['chat_room_id' => $id, 'user_id' => $user->id])->get()->isEmpty();
    $chatRoomUsers = \App\ChatRoomUser::where(['chat_room_id' => $id])->get();

    foreach ($chatRoomUsers as $chatRoomUser) {
        if ($chatRoomUser->user_id === $user->id) {
            return $user;
        }
    }

    return null;
});

