<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTainguyen extends Model
{
    use HasFactory;

    public $table = 'order_tainguyen';

    protected $fillable = [
        'username',
        'thongtin',
        'total_payment',
        'order_codes',
        'domain',
    ];
    protected $hidden = [
        'domain',

    ];
}
