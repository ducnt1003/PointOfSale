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
    public function listProd()
    {
        return Product::with(['category','brand'])->get();
    }

    public function addProd(Request $request)
    {
        $request->validate([
            'name' => "required|max:120|unique:products",
            'price' => 'required|min:0',
            'active' => 'required',
            'category_id' => 'required',
        ]);
        
        $product = new Product(
            [
                'name' => $request->get('name'),
                'category_id' => $request->get('category_id'),
                'brand_id' => $request->get('brand_id'),
                'price' => $request->get('price'),
                'import_price' => $request->get('import_price'),
                'active' => $request->get('active'),
                'description' => $request->get('description'), 
            ]
        );
        $path = $this->_upload($request);
        if ($path) {
            $product->photo = $path;
        }
        $product->save();
        return  $product;
    }

    private function _upload($request)
    {
        if ($request->file()) {
            try {
                $name = $request->file('photo')->getClientOriginalName();
                $pathFull = 'uploads/' . date("Y/m/d");
                $request->file('photo')->storeAs(
                    'public/' . $pathFull,
                    $name
                );
                return '/storage/' . $pathFull . '/' . $name;
            } catch (\Exception $error) {
                return false;
            }
            
        }
        return false;
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return Product::with(['category','brand'])->get();
    }
}
