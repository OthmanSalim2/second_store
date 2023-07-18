<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\NewOrderNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // here there is no need for adding this method if was use the default name of email felid
    public function routeNotificationForMail($notification = null)
    {
        // this's use just if check the notification and return the value that I need it
        // if ($notification instanceof NewOrderNotification) {
        //     return $this->email_address;
        // }
        // possible email here change according to for name of email felid in users table and this's if don't commit with standard
        // and this way use to say to laravel the email name it in users table as email_address
        return $this->email;
    }

    public function receivesBroadcastNotificationsOn($notification = null)
    {
        // Here to change name of channel
        return 'Notifications.' . $this->id;
    }

    public function routeNotificationForVonage($notification): string
    {
        // return $this->phone_number;
        // here I say to laravel the phone_number it's mobile felid
        return $this->mobile;
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function cartProducts()
    {
        return $this->belongsToMany(
            Product::class,
            'carts',
        )
            ->withPivot([
                'id', 'cookie_id', 'quantity'
            ])
            ->using(Cart::class)
            ->as('cart');
    }
}
