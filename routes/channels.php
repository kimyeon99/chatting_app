<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// 내가 추가
Broadcast::channel('chat', function ($user) {
    return auth()->check();
});

Broadcast::channel('chat.{roomId}', function ($user) {
     // return $user->isRoom == $room->id;
    //  return auth()->check();
     if (auth()->check()) {
         return ['id' => $user->id, 'name' => $user->name];
    //         return $user->toArray();
     }
    //return auth()->check();
});