<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Services\Category\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create()
    {
        return view(
            'admin.categories.create', [
            'title'=>'Thêm danh mục mới',
            'categories'=> $this->categoryService->getParent(),
            ]
        );
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->store($request);
        return redirect()->back();
    }
    public function index()
    {
        return view(
            'admin.categories.index', [
            'title'=>'Danh sách danh mục mới',
            'categories'=>$this->categoryService->getAll(),
            ]
        );
    }

    public function edit($id)
    {
        $category = $this->categoryService->getById($id);
        return view(
            'admin.categories.edit', [
            'title'=>'Chỉnh sửa danh mục: '.$category->name,
            'category'=>$category,
            'categories_parent'=>$this->categoryService->getParent(),
            ]
        );
    }

    public function update(CategoryRequest $categoryRequest,$id)
    {
        $category = $this->categoryService->getById($id);
        $this->categoryService->update($categoryRequest, $category);
        return redirect(route('admin.categories.index'));
    }

    public function destroy(Request $request)
    {
        $result = $this->categoryService->destroy($request);
        if ($result) {
            return response()->json(
                [
                'error'=>false,
                'message'=>'Xóa thành công danh mục'
                ]
            );
        }
        return response()->json(
            [
            'error'=>true
            ]
        );
    }

    public function listCate(){
        return Category::all();
    }

    // public function addCate(CategoryRequest $request)
    // {
    //     $category = $this->categoryService->store($request);
    //     return $category;
    // }

    public function addCate(Request $request){
        $category = new Category();
        //return $request;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->tax = $request->tax;
        $category->unit = $request->unit;
        $category->save();
        return $category;
        //return response()->json('successfully added');
    }

    public function editCate(Request $request,$id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->tax = $request->tax;
        $category->unit = $request->unit;
        $category->save();
        return response()->json('successfully edited');
    }

    public function deleteCate($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json('successfully deleted');

    }
}
