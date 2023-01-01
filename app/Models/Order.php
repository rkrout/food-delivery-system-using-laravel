<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetails;
use App\Models\DeliveryAdress;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'delivery_fee',
        'gst_percentage',
        'order_status_id',
        'user_id'
    ];

    public function details()
    {
        return $this->hasMany(OrderDetails::class);
    }
    public function deliveryAdress()
    {
        return $this->hasOne(DeliveryAdress::class);
    }
}
