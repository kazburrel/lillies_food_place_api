<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Cart extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = [
        'user',
        'price',
        'user_address',
        'user_phone',
        'meal_name',
        'quantity',
        'total_price',
    ];
}
