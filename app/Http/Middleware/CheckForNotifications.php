<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckForNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $notify_id = $request->query('notify_id');
        if ($notify_id) {
            $user = $request->user(); // Auth::user();

            // Mark all user's notifications as read
            //$user->notifications->markAsRead();

            $notification = $user->notifications()->find($notify_id);
            if ($notification && $notification->unread()) {
                // markAsRead this method store value to read_at felid in notifications table and covert from unread to read
                // mean make update for read_at felid to reading date
                $notification->markAsRead();

                // other way
                // $notification->update([
                //     'read_at' => now(),
                // ]);
            }
        }

        return $next($request);
    }
}
