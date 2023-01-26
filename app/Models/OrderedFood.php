<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderedFood extends Model
{
    use HasFactory;

    protected $table = 'ordered_foods';

    protected $fillable = [
        'name',
        'qty',
        'price',
        'order_id'
    ];
}
