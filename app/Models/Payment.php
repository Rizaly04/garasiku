<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'service_order_id', 
        'amount', 
        'payment_method', 
        'paid_at'
    ];

    public function serviceOrder()
    {
        return $this->belongsTo(ServiceOrder::class);
    }
}
