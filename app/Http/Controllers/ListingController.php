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
        $conditions = $model->getFilter($request, $configs);
        $records = $model::where($conditions)->paginate(5);
        return view('admin.listing', [
            'user' => $adminUser,
            'records' => $records,
            'configs' => $configs,
            'modelName' => $modelName,
            'title' =>$model->title,
            'use' =>$model->use,

        ]);
    }
}
