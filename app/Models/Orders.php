<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    public $table = 'orders';

    protected $fillable = [
        'username',
        'service_id',
        'service_name',
        'server_service',
        'price',
        'host',
        'pass',
        'port',
        'ipv6',
        'loai',
        'quocgia',
        'timebuy',
        'timeend',
        'quantity',
        'total_payment',
        'order_code',
        'order_link',
        'start',
        'buff',
        'actual_service',
        'actual_path',
        'actual_server',
        'status',
        'action',
        'timestart',
        'dataJson',
        'error',
        'isShow',
        'note',
        'history',
        'refund',
        'domain',
        'speed',
        'proxy_id',
        'name',
        'proxy',
        'user',
        'user_id',
    ];

    protected $hidden = [
        'domain',
         
    ];

}
