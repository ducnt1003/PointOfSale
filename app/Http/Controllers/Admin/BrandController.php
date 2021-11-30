<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        return view(
            'admin.brands.index', [
            'title' => 'Danh sách brand',
            'brands' => $brands
            ]
        );
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            return view(
                'admin.brands.edit', [
                'title' => 'Chỉnh sửa brand',
                'brand' => $brand
                ]
            );
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            $path = $this->_upload($request);
            if ($path) {
                $brand->photo = $path;
            }
            $brand->name = $request->input('name');
            $brand->save();
        }
        return redirect(route('admin.brands.index'))
            ->with('success', __('sửa brand thành công!'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $brand = new Brand();
        return view(
            'admin.brands.create', [
            'title' => 'Thêm brand mới',
            'brand' => $brand
            ]
        )->with('success', __('Thêm brand thành công!'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(BrandRequest $request)
    {
        $data = $request->except('_token');
        $data = array_filter($data, 'strlen');
        $path = $this->_upload($request);
        if ($path) {
            $data['photo'] = $path;
        }
        $brand = Brand::create($data);


        return redirect(route('admin.brands.index'))
            ->with('success', __('Thêm thành công'));
    }

    /**
     * destroy
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request)
    {
        $brand = Brand::find($request->input('brand_id'));
        if ($brand) {
            $brand->delete();
            //Storage::delete($brand->photo);
            return redirect(route('admin.brands.index'))
                ->with('success', __('Xóa thành công!'));
        }
        return redirect(route('admin.brands.index'))
            ->with('error', __('xóa không thành công!'));
    }

    /**
     * _upload
     *
     * @param  mixed $request
     * @return void
     */
    private function _upload($request)
    {
        if ($request->hasFile('photo')) {
            try {
                $name = $request->file('photo')->getClientOriginalName();
                $pathFull = 'uploads/' . date("Y/m/d");
                $request->file('file')->storeAs(
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

    /**
     * storeBrand
     *
     * @param  mixed $request
     * @return void
     */
    public function storeBrand(Request $request)
    {
        $brand = new Brand(
            [
            'name' => $request->get('name'),
            ]
        );

        $brand->save();

        return response()->json('successfully added');
    }
    /**
     * indexBrand
     *
     * @return void
     */
    public function indexBrand()
    {
        return Brand::orderBy('id', 'asc')->get();
    }
    /**
     * editBrand
     *
     * @param  mixed $id
     * @return void
     */
    public function editBrand($id)
    {
        $brand = Brand::find($id);
        return response()->json($brand);
    }
    /**
     * updateBrand
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     */
    public function updateBrand($id, Request $request)
    {
        $brand = Brand::find($id);

        $brand->update($request->all());
        $brand->save();

        return response()->json('successfully updated');
    }
    /**
     * deleteBrand
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteBrand($id)
    {
        $brand = Brand::find($id);

        $brand->delete();

        return response()->json('successfully deleted');
    }
}
