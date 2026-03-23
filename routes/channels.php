<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('chat.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('group-chat', function ($user) {
    return true;
});



Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// Broadcast::channel('notifications.{userId}', function ($user, $userId) {
//     return (int) $user->id === (int) $userId;
// });// Broadcast::channel('notifications.{userId}', function ($user, $userId) {
//     return (int) $user->id === (int) $userId;
// });