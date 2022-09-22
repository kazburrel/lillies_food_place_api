<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class meal extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'meal_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'meal_id','vendor_id', 'meal_name', 'meal_details', 'meal_price', 'meal_avatar'
    ];
}
