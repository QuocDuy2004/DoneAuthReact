<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tainguyen extends Model
{
    use HasFactory;

    protected $table = 'tainguyen';

    protected $fillable = [
        'name',
        'thongtin',
        'price',
        'price_collaborator',
        'price_agency',
        'price_distributor',
        'category_id',
        'description',
        'daban',
        'domain',
    ];

    protected $hidden = ['domain'];
}
