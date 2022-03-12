<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title', 
        'author', 
        'content',
    ];

    public function getDobAttribute($value)
    {
        return Carbon::parse($value)->format('dd/mm/yyyy')->toDateString();
    }
    
    public function setCreatedAtAttribute($value) 
    {
        $this->attributes['created_at'] = Carbon::createFromFormat("dd/mm/yyyy", $value)->toDateString();
    }
}
