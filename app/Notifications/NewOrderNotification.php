<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;


class NewOrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */

    // here laravel passed $notifiable object
    public function via(object $notifiable): array
    {
        // return ['mail', 'database','broadcast'];
        // vonage this for sms service
        return ['database', 'vonage'];


        // this other way when use the $notifiable
        // here $notifiable it use to make configuration of channel and depending on the user  as
        $via = ['database'];
        // notify_sms mean possible be found me table contains name of channel and contains of notify_sms column
        if ($notifiable->notify_sms) {
            $via[] = 'nexmmo';
        }

        if ($notifiable->notify_mail) {
            $via[] = 'mail';
        }

        if ($notifiable->notify_broadcast) {
            $via[] = 'broadcast';
        }

        return $via;

        // here the important return name of channel
        // they are channels
        // mail, database, broadcast, nexmo (sms), slack
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // here $notifiable refer to User model
        return (new MailMessage)
            // this represent title of mail notification
            ->subject('New Order')
            // this welcome line
            // $notifiable->name ?? '' this's if need send custom route for users not found me
            ->greeting('Hello,' . $notifiable->name ?? '')
            // here write the email that will send from it the messages
            ->from('notify@localhost', 'Maan Billing')
            ->line('A New Order Created.')
            ->action('View Order', url('/'))
            ->line('Thank you for using our application!');
        // ->view('mails.new-order', [
        //     'name' => $notifiable->name ?? '',
        //     'url' => '/'
        // ]);
    }

    public function toDatabase($notifiable)
    {
        // they're will store to data felid in notifications table
        return [
            'title' => 'New Order',
            'body' => 'A new order created',
            'image' => '',
            'link' => url('/'),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => 'New Order',
            'body' => 'A new order created',
            'image' => '',
            'link' => url('/'),
        ]);

        // other way
        // return [
        //     'title' => 'New Order',
        //     'body' => 'A new order created',
        //     'image' => '',
        //     'link' => url('/'),
        // ];
    }

    public function toVonage(object $notifiable): VonageMessage
    {
        return (new VonageMessage)
            ->content('New Order Created');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

    // this's will used if any function not found for any channel and laravel automatic will used
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    // this's method to change the type of broadcast sent
    // if this method not found will type take namespace with class name this's default
    // type and id laravel sent those with broadcast I don't added those!!.
    public function broadcastType(): string
    {
        return 'NewOrder';
    }
}
