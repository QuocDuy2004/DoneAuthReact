<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryOrder extends Model
{
    use HasFactory;
    
    public $table = 'history_order';
    
    protected $fillable = [
        'username',
        'taodon',
        'thaydoi',
        'sodu',
        'soduhientai',
        'ip',
        'dongia',
        'dichvu',
        'donhang',
        'data_json',
        'linkorder',
        'maychu',
        'soluong',
        'domain',
    ];

    protected $hidden = [
        'domain',
    ];
}
