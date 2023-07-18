<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationMenu extends Component
{
    public $notifications;
    public $unread;

    /**
     * Create a new component instance.
     */
    public function __construct($count = 10)
    {
        $user = Auth::user();
        // notifications this's relation in laravel between user and notification
        // possible use limit or take
        $this->notifications = $user->notifications()
            ->take($count)
            ->get();
        $this->unread = $user->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification-menu');
    }
}
