<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'unique_id',
        'user',
        'receiver_name',
        'receiver_address',
        'receiver_phone',
        'meal',
        'total_price',
        'status'
    ];

    public function toSearchableArray()
    {
        return [
            'unique_id' => $this->unique_id,
            'receiver_name' => $this->receiver_name,
            'receiver_address' => $this->receiver_name,
            'receiver_phone' => $this->receiver_phone,
            'meal' => $this->meal,
            'status' => $this->status,
        ];
    }

    public function customerDetails()
    {
        return $this->belongsTo(User::class, 'user', 'unique_id');
    }
}
