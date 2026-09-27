<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrderItem extends Model
{
    protected $fillable = [
        'service_order_id', 
        'service_id', 
        'part_id', 
        'quantity', 
        'price', 
        'subtotal'
    ];

    public function serviceOrder()
    {
        return $this->belongsTo(ServiceOrder::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}
