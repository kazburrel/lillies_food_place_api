<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Searchable;
    
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'unique_id',
        'name',
        'company_name',
        'email',
        'password',
        'address',
        'phone',
        'status',
        'vendor_avatar',
        'type'
    ];

    public function toSearchableArray()
    {
        return [
            'unique_id' => $this->unique_id,
            'name' => $this->name,
            'email' => $this->email,
            'company_name'=> $this->company_name,
            // 'lecturer' => $this->lecture,
        ];
    }
}
