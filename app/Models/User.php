<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'username',
        'password',
        'balance',
        'type_balance',
        'total_recharge',
        'total_deduct',
        'level',
        'api_token',
        'ip',
        'lang',
        'avatar',
        'domain',
        'telegram_chat_id',
        'facebook',
        'status',
        'email_verified',
        'email_verified_at',
        'telegram_verified',
        'telegram_notice',
        'remember_token',
        'referral_link',
        'referral_code',
        'referral_money',
        'ref_id',
        'last_login',
        'position',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'api_token',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string, string>
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'email_verified_at',
        'last_login',
    ];

    /**
     * The attributes that are of longtext type.
     *
     * @var array<string>
     */
    protected $attributes = [
        'total_recharge' => '',
        'total_deduct' => '',
        'facebook' => '',
        'referral_money' => '',
    ];
}
