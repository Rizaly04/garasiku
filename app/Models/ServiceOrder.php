<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    protected $fillable = [
        'customer_id', 
        'vehicle_id', 
        'mechanic_id', 
        'status',
        'check_in_date', 
        'complete_date', 
        'total_price'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(User::class, 'mechanic_id');
    }

    public function items()
    {
        return $this->hasMany(ServiceOrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
