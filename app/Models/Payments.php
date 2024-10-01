<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'type',
        'account_name',
        'account',
        'account_number',
        'password',
        'api_token',
        'qr_code',
        'logo',
        'domain',
    ];

    protected $hidden = [
        'password',
        'api_token',
        'domain'
    ];
}
