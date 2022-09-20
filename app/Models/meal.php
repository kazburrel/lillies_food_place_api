<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class meal extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'vendor_id', 'meal_name', 'meal_details', 'meal_price', 'meal_avatar'
    ];
}
