<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    protected $table = 'posts';
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
      'title',
      'url',
      'content' ,
      'writer_id',
      'photo_path',
      'created_at'
  ];
    function comments(){
      return $this->hasMany('App\Models\Comment')->orderBy('id','desc');
  }
    public function categories() {
        return $this->belongsToMany('App\Models\Category');
      }
}
