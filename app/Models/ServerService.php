<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerService extends Model
{
    use HasFactory; 

    protected $table = 'server_services';

    protected $fillable = [
        'name',
        'social_id',
        'service_id',
        'socialll',
        'server',
        'price',
        'price_collaborator',
        'price_agency',
        'price_distributor',
        'limitDay',
        'min',
        'max',
        'title',
        'description',
        'status',
        'actual_service',
        'actual_server',
        'actual_path',
        'actual_price',
        'action',
        'order_type',
        'warranty',
        'domain',
    ];

    protected $hidden = ['domain'];

    public function getServerByService($service_id)
    {
        return $this->where('domain', getDomain())->where('service_id', $service_id)->get();
    }
}
