<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    public $table = 'tickets';

    protected $fillable = [
        'username',
        'text',
        'reply',
        'parent_id',
        'status',
        'domain',
    ];

}
