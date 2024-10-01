<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitiessystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'status',
        'domain'
    ];

    protected $table = 'activitiessystem';

    protected $hidden = ['domain'];
}
