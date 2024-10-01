<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
   
    protected $fillable = [
        'currency_name', 'currency_code', 'currency_symbol', 'rate', 'currency_position', 'status'
    ];
    
}
