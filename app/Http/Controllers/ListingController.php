<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller {

    public function index(Request $request, $modelName) {
        $adminUser = Auth::guard('admin')->user();
        $model = '\App\Models\\' . ucfirst($modelName);
        $model = new $model;
        $configs = $model->listingConfigs();
        $filterResult = $model->getFilter($request, $configs, $modelName);
        $orderBy = [
            'field' => 'created_at',
            'sort' => 'desc'
        ];
        if ($request->input('sort')) {
            $field = substr($request->input('sort'), 0, strrpos($request->input('sort'), "_"));
            $sort = substr($request->input('sort'), strrpos($request->input('sort'), "_") + 1);
            $orderBy = [
                'field' => $field,
                'sort' => $sort
            ];
        }
        $records = $model->getRecords($filterResult['conditions'], $orderBy);
        return view('admin.listing', [
            'user' => $adminUser,
            'records' => $records,
            'configs' => $configs,
            'modelName' => $modelName,
            'title' =>$model->title,
            'use' =>$model->use,
            'orderBy'=>$orderBy,
        ]);
    }
}
