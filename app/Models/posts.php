<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Base;

class posts extends Base {
    
    use HasFactory;
    public $title = "Post";
    public $use = "Quản lý bài viết";
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
                'field' => 'user_post',
                'name' => 'Tên User',
                'type' => 'text',
                'filter' => 'like'
            ),
            
            array(
                'field' => 'title',
                'name' => 'Title',
                'type' => 'text',
                'filter' => 'like'
            ),
            array(
                'field' => 'URL',
                'name' => 'URL',
                'type' => 'text',
                'filter' => 'like'
            ),
            array(
                'field' => 'created_at',
                'name' => 'Thời gian tạo',
                'type' => 'text',
                
            )
        );
        return array_merge($listingConfigs, $defaultListtingConfigs);
    }
}

