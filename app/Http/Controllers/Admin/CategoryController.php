<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $categories = $this->categoryRepository->getListCategory($data);

        return view('auth.category.listCategory', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $dataInsert = [
            'category_name' => $request['category_name'],
            'description' => $request['description'],
        ];

        if(!empty($this->categoryRepository->findCategoryByName($dataInsert))) {
            return back()->with('error', 'Category name exists')->withInput($request->all());
        }

        $category = $this->categoryRepository->createCategory($dataInsert);

        if ($request->ajax()) {
            return response()->json([
                'category' => $category,
            ]);
        }

        return back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->findCategory($id);

        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->findCategory($id);

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request)
    {
        $dataUpdate = [
            'id' => $request['id'],
            'category_name' => $request['category_name'],
            'description' => $request['description'],
        ];

        if(!empty($this->categoryRepository->findCategoryByName($dataUpdate))) {
            return response()->json(['error'=>'Category exists']);
        }

        $this->categoryRepository->updateCategory($dataUpdate);

        if ($request->ajax()) {
            return response()->json([
                'category' => $dataUpdate,
            ]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryRepository->deleteCategory($id);

        return response()->json();
    }
}
