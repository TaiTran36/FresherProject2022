<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


class Permission extends Model
{
    use HasFactory;
    public function roles(){
        return $this->belongsToMany(Role::class,'role_permission');
    }
    public function checkPermission($permission){
        $data = Auth::user()->role->permissions;
        $arrPermission = [];
        foreach($data as $value) $arrPermission[] = $value->name;
        $collection = new Collection($arrPermission);
        if($collection->contains($permission)){
            return true;
        }
        return false;
    }

  
}
