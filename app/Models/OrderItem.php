<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class OrderItem extends Model
{
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'unique_id',
        'cart_id',
        'meal_thumb',
        'meal_name',
        'meal_price',
        'quantity',
        'sub_total',
    ];

    public function cartItems(){
        return $this->belongsTo(Order::class, 'cart_id', 'unique_id');
    }
}