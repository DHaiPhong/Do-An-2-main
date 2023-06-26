<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category_blog()
    {
        return $this->belongsTo('App\Category_blog', 'category_blog_id');
    }
}
