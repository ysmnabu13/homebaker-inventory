<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'inventory_id',
        'order_quantity',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
