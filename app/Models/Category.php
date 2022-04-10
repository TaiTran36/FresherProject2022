<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    use HasFactory;
    public function post() {
        return $this->belongsToMany('App\Models\Post', 'post_category', 'post_id', 'category_id');
      }
}
