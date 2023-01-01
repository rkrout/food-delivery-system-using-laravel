<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAdress extends Model
{
    use HasFactory;

    protected $table = 'delivery_addresses';

    protected $fillable = [
        'name',
        'mobile',
        'street',
        'instruction',
    ];
}
