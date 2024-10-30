<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_name',
        'model',
        'year',
        'vin',
        'color',
        'price',
        'availability_status', // Assuming this is a boolean (true/false) to indicate availability
    ];
}