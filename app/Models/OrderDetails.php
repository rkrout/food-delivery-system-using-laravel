<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'food',
        'qty',
        'price',
        'order_id'
    ];
}
