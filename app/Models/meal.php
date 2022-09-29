<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class meal extends Model
{
    use HasFactory, SoftDeletes,Searchable;

    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'unique_id',
        'vendor',
        'meal_name',
        'meal_details',
        'meal_price',
        'quantity',
        'meal_avatar',
        'status'
    ];
    // public function scopeFilter($query, array $filters)
    // {
    //     if ($filters['search'] ?? false) {
    //         $query->where('meal_name', 'like', '%' . request('search') . '%')

    //             ->orWhere('vendor', 'like', '%' . request('search') . '%')

    //             ->orWhere('unique_id', 'like', '%' . request('search') . '%');
    //     }
    // }

    public function toSearchableArray()
    {
        return [
            'unique_id' => $this->unique_id,
            'meal_name' => $this->meal_name,
            'vendor' => $this->vendor,
            // 'lecturer' => $this->lecture,
        ];
    }

    public function vendordets(){
        return $this->belongsTo( Vendor::class, 'vendor', 'unique_id');
    }
}


