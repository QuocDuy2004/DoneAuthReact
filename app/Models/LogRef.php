<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogRef extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'ref_id',
        'domain'
    ];

    protected $table = 'log_ref';

    protected $hidden = ['domain'];
}
