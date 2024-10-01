<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'name',
        'action',
        'data',
        'old_data',
        'new_data',
        'ip',
        'description',
        'linkorder',
        'maychu',
        'soluong',
        'dongia',
        'data_json',
        'domain',
    ];

    protected $hidden = [
        'domain'
    ];
}
