<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    use HasFactory;
    function comments(){
      return $this->hasMany('App\Models\Comment')->orderBy('id','desc');
  }
    public function categories() {
        return $this->belongsToMany('App\Models\Category');
      }
}
