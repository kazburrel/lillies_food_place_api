<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'unique_id',
        'meal_id',
        'user_id',
        'full_name',
        'address',
        'mobile',
        'quantity',
        'total_amount',
        'delivery_status',
        'order_status',
    ];
}
