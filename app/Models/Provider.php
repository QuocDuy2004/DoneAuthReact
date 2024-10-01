<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'providers';

    protected $fillable = [
        'url',
        'key',
        'name',
        'balance',
        'currency',
        'sync',
        'status',
        'username',
        'password',
        'file_name',
    ];

    // Đặt thuộc tính timestamps thành true để tự động cập nhật created_at và updated_at
    public $timestamps = true;
}
