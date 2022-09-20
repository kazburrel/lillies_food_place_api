<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class vendor extends Authenticatable
{
    protected $primaryKey = 'vendor_id';
    public $incrementing = false;
    protected $keyType = 'string';

    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'vendor_id',
        'name',
        'company_name',
        'email',
        'password',
        'address',
        'phone',
        'vendor_avatar'
    ];

}
