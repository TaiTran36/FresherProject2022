<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model {

    use HasFactory;

    public function getRecords($conditions){
        $per_page = 1;
        return self::where($conditions)->paginate($per_page);
    }

    public function getFilter($request, $configs) {
        $conditions = [];
        if ($request->method() == "POST") {
            foreach ($configs as $config) {
                if (!empty($config['filter'])) {
                    $value = $request->input($config['field']);
                    switch ($config['filter']) {
                        case "equal":
                            if (!empty($value)) {
                                $conditions[] = [
                                    'field' => $config['field'],
                                    'condition' => '=',
                                    'value' => $value
                                ];
                            }
                            break;
                        case "like":
                            if (!empty($value)) {
                                $conditions[] = [
                                    'field' => $config['field'],
                                    'condition' => 'like',
                                    'value' => '%' . $value . '%'
                                ];
                            }
                            break;
                        
                    }
                }
            }
        }
        return $conditions;
    }

    public function defaultListingConfigs() {
        return array(
            array(
                'field' => 'detail',
                'name' => 'Xem',
                'type' => 'Detail'
            ),
            array(
                'field' => 'Edit',
                'name' => 'Sửa',
                'type' => 'Edit'
            ),array(
                'field' => 'delete',
                'name' => 'Xóa',
                'type' => 'Delete'
            )
        );
    }
    
    

}
