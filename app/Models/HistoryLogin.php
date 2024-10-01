<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLogin extends Model
{
    use HasFactory;
    
    public $table = 'history_login';
    
    protected $fillable = [
        'username',
        'action',
        'dangnhap',
        'domain',
    ];

    protected $hidden = [
        'domain',
    ];
}
