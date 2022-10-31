<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class FavVendor extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'unique_id',
        'vendor',
        'user',
    ];

    public function vendorDets()
    {
        return $this->belongsTo(Vendor::class, 'unique_id', 'vendor');
    }

    public function userDets()
    {
        return $this->belongsTo(User::class, 'unique_id', 'user');
    }
}
