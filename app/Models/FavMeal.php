<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class FavMeal extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'unique_id',
        'meal',
        'user',
    ];

    public function mealDets()
    {
        return $this->belongsTo(meal::class, 'meal', 'unique_id');
    }

    // public function userDets()
    // {
    //     return $this->belongsTo(User::class, 'user', 'unique_id');
    // }
}
