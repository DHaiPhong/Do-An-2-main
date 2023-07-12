<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $dates = ['expires_at'];

    protected $fillable = ['code', 'amount', 'slug', 'type', 'expires_at'];
}
