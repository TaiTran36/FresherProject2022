<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Base extends Model {

    use HasFactory;

    public function getRecords($conditions, $orderBy) {
        $per_page = 5;
        return self::orderby($orderBy['field'],$orderBy['sort'])->where($conditions)->paginate($per_page)->withQueryString();
    }

    public function getFilter($request, $configs, $modelName) {
        $conditions = [];
        if ($request->method() == "POST") {
            foreach ($configs as &$config) {
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
                                $config['filter_value'] = $value;
                            }
                            break;
                        case "like":
                            if (!empty($value)) {
                                $conditions[] = [
                                    'field' => $config['field'],
                                    'condition' => 'like',
                                    'value' => '%' . $value . '%'
                                ];
                                $config['filter_value'] = $value;
                            }
                            break;
                        
                    }
                }
            }
            Cookie::queue(strtolower($modelName) . '_filter', json_encode($conditions), 24 * 60); //Cookie: 24 hours
        } else { //Method: GET
            $conditions = json_decode(Cookie::get(strtolower($modelName) . '_filter'));
            if (!empty($conditions)) {
                foreach ($conditions as &$condtion) {
                    $condtion = (array) $condtion;
                    foreach ($configs as &$config) {
                        if ($config['field'] == $condtion['field']) {
                            switch ($config['filter']) {
                                case "equal":
                                    $config['filter_value'] = $condtion['value'];
                                    break;
                                case "like":
                                    $config['filter_value'] = str_replace("%", "", $condtion['value']);
                                    break;
                                case "between":
                                    if ($condtion['condition'] == ">=") {
                                        $config['filter_from_value'] = str_replace("%", "", $condtion['value']);
                                    } else {
                                        $config['filter_to_value'] = str_replace("%", "", $condtion['value']);
                                    }
                                    break;
                            }
                        }
                    }
                }
            }
        }
        return array(
            'conditions' => $conditions,
            'configs' => $configs,
        );
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
