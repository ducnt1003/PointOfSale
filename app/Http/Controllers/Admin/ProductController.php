<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Services\Product\ProductService;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Picqer;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view(
            'admin.products.index', [
            'title'=>'Danh sách sản phẩm',
            'products'=>$this->productService->get(),
            ]
        );
    }
    public function create()
    {
        $categories = Category::orderBy('id')->get();
        $brands = Brand::orderBy('id')->get();

        $product_code = rand();
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($product_code, $generator::TYPE_CODE_128);
        return view(
            'admin.products.create', [
            'title'=>'Thêm sản phẩm mới',
            'categories'=>$categories,
            'product_code'=>$product_code,
            'barcode'=>$barcode,
            'currentusers' => Auth::user(),
            'brands'=>$brands,
            ]
        );
    }

    public function store(ProductRequest $request)
    {
        $this->productService->store($request);
        return redirect()->back();
    }

    public function edit($id)
    {
        $brands = Brand::orderBy('id')->get();
        $categories = Category::orderBy('id')->get();
        $product = $this->productService->getById($id);
        $users = User::orderBy('id')->get();
        return view(
            'admin.products.edit', [
            'title'=>'Chỉnh sửa sản phẩm: ' . $product->name,
            'categories'=>$categories,
            'product'=>$product,
            'brands'=>$brands,
            'currentusers' => Auth::user(),
            ]
        );
    }


    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $this->productService->update($request, $product);
        return redirect(route('admin.products.index'));
    }


    public function destroy(Request $request)
    {
        $result = $this->productService->destroy($request);
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

    public function getBarcode($id)
    {
        $product = Product::find($id);
        return view(
            'admin.products.barcode', [
            'product'=>$product,
            ]
        );
    }


    public function quotation()
    {
        return view(
            'admin.products.quotation', [
            'title'=>'Giá sản phẩm',
            'products'=>$this->productService->get(),
            ]
        );
    }

    public function listProd(){
        return Product::all();
    }

    public function addProduct(Request $request){
        $product = new Product();
        $product_code = rand();
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($product_code, $generator::TYPE_CODE_128);
        $product->product_code = $product_code;
        $product->barcode = $barcode;
        $product->name = $request -> name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->color =  $request->color;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->import_price = $request->import_price;
//        if ($request->hasFile('img')){
//            $file = $request->file('img');
//            $file_name = time().'.'.$file->getClientOriginalName();
//            $path = $file->move(public_path('image'),$file_name);
//            $product->photo = $path;
//        }
        $product->save();
        return $product;
    }

    public function editProduct(Request $request,$id){
        $product = Product::find($id);
        $product->name = $request -> name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->color =  $request->color;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->import_price = $request->import_price;
        $product->save();
        return response()->json('successfully edited');
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
        return response()->json('successfully deleted');
    }
}
