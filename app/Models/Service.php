<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'price'];

    public function orderItems()
    {
        return $this->hasMany(ServiceOrderItem::class);
    }
}
