<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckForNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $notify_id = $request->query('notify_id');
        if ($notify_id) {
            $user = $request->user(); // Auth::user()

            // this's for collection of notification
            // mark all user's notification as read and store date in read_at in notification table
            // $user->notifications->markAsRead();

            // this's for single notification
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
