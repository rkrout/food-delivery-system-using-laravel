<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderedFood;
use App\Models\DeliveryAddress;
use App\Models\paymentDetails;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'delivery_fee',
        'gst_percentage',
        'status',
        'user_id'
    ];

    public function foods()
    {
        return $this->hasMany(OrderedFood::class);
    }
    
    public function deliveryAddress()
    {
        return $this->hasOne(DeliveryAddress::class);
    }

    public function paymentDetails()
    {
        return $this->hasOne(PaymentDetails::class);
    }
}
