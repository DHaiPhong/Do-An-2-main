<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = [
        'cat_id', 'prd_name', 'prd_details', 'price', 'sale',
    ];

}
