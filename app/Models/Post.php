<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected  $table = 'posts';
    protected $fillable = [
        'name',
        'post_title',
        'post_body',
        'post_url',
        'post_author',
        'post_thumbnail',
        'post_category',
        'created_at',
    ];
    public function userInfo(){
        return $this->belongsTo(Profile::class, 'user_id');
    }
    public function categories() {
        return $this->belongsToMany(Categories::class);
    }
    
}
