<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Base;

class Users extends Base {


    use HasFactory;

    public $title = "Users";
    public $use = "Quản lý người dùng";
    public function listingConfigs() {
        $defaultListtingConfigs = parent::defaultListingConfigs();
        $listingConfigs =  array(
            array(
                'field' => 'id',
                'name' => 'ID',
                'type' => 'text',
                'filter' => 'equal'
            ),
            array(
                'field' => 'name',
                'name' => 'Tên User',
                'type' => 'text',
                'filter' => 'like'
            ),
            array(
                'field' => 'image',
                'name' => 'Ảnh sản phẩm',
                'type' => 'image'
            ),
            array(
                'field' => 'email',
                'name' => 'Email',
                'type' => 'text',
                'filter' => 'like'
            ),
            array(
                'field' => 'phone_number',
                'name' => 'Số điện thoại',
                'type' => 'text',
                'filter' => 'like'
            )
        );
        return array_merge($listingConfigs, $defaultListtingConfigs);
    }
}

