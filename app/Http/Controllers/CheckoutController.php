<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CheckoutController extends Controller
{
    public function create()
    {
        // single notification
        $user = User::find(1);
        $user->notify(new NewOrderNotification);

        // multiple notification
        // this way to send notification to multiple user
        // $users = User::all();
        // foreach ($users as $user) {
        //     Notification::send($user, new NewOrderNotification);
        // }

        // custom route
        // this's way to send mail notification and they're not found me
        // Notification::route('mail', 'admin1@localhost')
        // this's way do not apply on database and broadcast
        // ->route('nexmo', '9705911223334')
        // ->notify(new NewOrderNotification);

        return "Notification it's send!";
    }
}
