<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'order_id', 'reference_no', 'tax', 'service_charge', 'total_amount_cents', 'is_walkin', 'status'
    ];

    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItems', 'order_id', 'id');
    }

    public function transactions()
    {
        return $this->hasOne('App\Models\Transactions', 'order_id', 'id');
    }

}
