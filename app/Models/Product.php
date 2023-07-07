<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * @var array
     */
    protected $fillable = [
        'cat_id', 'prd_name', 'prd_details', 'price', 'prd_sale',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function images()
    {
        return $this->hasMany(Images::class);
        
    }
}
