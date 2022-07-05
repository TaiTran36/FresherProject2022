<?php

namespace App\Http\Controllers;

use App\Events\DashboardCategoryEvent;
use Illuminate\Http\Request;
use App\Repositories\PostRepositories;
use App\Repositories\CategoryRepositories;
use App\Repositories\UserRepositories;

class CategoryController extends Controller
{
    public function __construct(PostRepositories $postRepository, CategoryRepositories $categoryRepository, UserRepositories $userRepository)
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function index(Request $request)
    {
        $listcat = $this->categoryRepository->getAll_paginate(5);
        $data = view('category.list', compact('listcat'))->render();
        return $data;
    }
    function get_list(Request $request)
    {
        $number = 5;
        if ($request->number) {
            $number = $request->number;
        }
        if ($request->ajax()) {
            $listcat = $this->categoryRepository->getAll_paginate($number);
            return view('category.data', compact('listcat'))->render();
        }
    }
    function count(Request $request)
    {
        if ($request->ajax()) {
            $listcat = $this->categoryRepository->getAll_paginate(5);
            return response($listcat->total());
        }
    }
    public function search(Request $request)
    {
        $number = 5;
        if ($request->number) {
            $number = $request->number;
        }
        if ($request->ajax()) {
            $listcat = $this->categoryRepository->search($request->search, $number);
            return view('category.data', compact('listcat'))->render();
        }
    }
    public function search_results_all(Request $request)
    {
        $number = 5;
        if ($request->number) {
            $number = $request->number;
        }
        if ($request->ajax()) {
            $output2 = '';
            $listcat = $this->categoryRepository->search($request->search, $number);
            if ($listcat) {
                $output2 .= $listcat->total();
            }
            return Response($output2);
        }
    }
    public function destroy(Request $request)
    {
        $number = 5;
        if ($request->number) {
            $number = $request->number;
        }
        if ($request->ajax()) {
            $this->categoryRepository->delete($request->id);
            $listcat = $this->categoryRepository->getAll($number);
            $data = view('category.data', compact('listcat'))->render();
            return response($data);
        }
    }
    public function insert(Request $request)
    {
        if ($request->ajax()) {
            if ($this->categoryRepository->check($request->new_cat)) {
                $this->categoryRepository->insert($request->new_cat);
                $listcat = $this->categoryRepository->getAll(5);
                $data = view('category.data', compact('listcat'))->render();
            } else {
                $data = 0;
            }
            event(new DashboardCategoryEvent());
            return response($data);
        }
    }
    public function edit(Request $request)
    {
        if ($request->ajax()) {
            if ($this->categoryRepository->check($request->name)) {
                $this->categoryRepository->update($request->id, $request->name);
                $cat = $request->name;
                $data = $cat;
            } else {
                $data = 0;
            }
            event(new DashboardCategoryEvent());
            return response($data);
        }
    }
}
