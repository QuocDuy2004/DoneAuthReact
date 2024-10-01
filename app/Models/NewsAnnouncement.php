<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsAnnouncement extends Model
{
    use HasFactory;
    
    public $table = 'newsannouncement';
    
    protected $fillable = ['name', 'content', 'notice', 'class', 'domain'];

    protected $hidden = ['domain'];
}
