<?php

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

// I here change name of channel according to receivesBroadcastNotificationsOn() method in User model
Broadcast::channel('Notifications.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
