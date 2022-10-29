<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $module_data = Product::select('id', 'sku', 'category_id', 'subcategory_id', 'product_name', 'images', 'status', 'created_at')
            ->with('category', 'categories', 'subcategories')
            ->get();
        return view('admin.product.index', compact('module_data'));
    }
    public function create()
    {
        $category = category::select('id', 'name', 'status')->where('status', '1')->get();
        $sub_category = Subcategory::select('id', 'category_id', 'name', 'status')->where('status', '1')->get();
        return view('admin.product.create', compact('category', 'sub_category'));
    }
    public function store(Request $request)
    {
        $rules = [
            'category_name'     => ['required'],
            'subcategory_name'  => ['required'],
            'product_name'      => ['required'],
            'images'             => ['required'],
            'size'              => ['required'],
            'description'       => ['required'],
            'price'             => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $data                = new Product();
            if ($request->hasFile('images')) {
                try {
                    $slug = Str::slug($request['product_name'], '-');
                    $Image = $slug . '-product-' . time() . '.' . $request->file('images')->guessExtension();
                    $path = '/images/product';
                    $request->file('images')->storeAs($path, $Image, 'public');
                    $data['images'] = $Image;
                } catch (\Exception $e) {
                    return back()->with('error', 'Could not upload your file', $e->getMessage());
                }
            }
            $data['category_id']        = $request['category_name'];
            $data['subcategory_id']     = $request['subcategory_name'];
            $data['product_name']       = $request['product_name'];
            $data['size']               = $request['size'];
            $data['description']        = $request['description'];
            $data['price']              = $request['price'];
            $data->save();
            $cat = [];
            array_push($cat, $request['category_name']);
            array_push($cat, $request['subcategory_name']);
            $data->category()->sync($cat);
            return redirect()->route('product.index')->with('success', 'Product saved successfully.');
        }
    }
    public function status($id)
    {
        $status = Product::where('id', $id)->first();
        if ($status->status == '1') {
            $status   = '0';
        } else {
            $status   = '1';
        }
        Product::where('id', $id)->update(['status' => $status]);
        return back()->with('success', 'Status update successfully.');
    }
    public function destroy($id)
    {
        $data = Product::find($id);
        $data->delete();
        return back()->with('success', 'Delete Successfully.');
    }
    public function edit($id)
    {
        $data = Product::with('categories', 'subcategories')->find($id);
        $category = category::select('id', 'name', 'status')->where('status', '1')->get();
        $sub_category = Subcategory::select('id', 'category_id', 'name', 'status')->where('status', '1')->get();
        return view('admin.product.edit', compact('data', 'category', 'sub_category'));
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'category_name'     => ['required'],
            'subcategory_name'  => ['required'],
            'product_name'      => ['required'],
            'images'             => ['nullable'],
            'size'              => ['required'],
            'price'             => ['required'],
            'description'       => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $data = Product::find($id);
            if ($request->hasFile('images')) {
                $files = ('storage/images/product/' . $data->images);
                if (file_exists($files)) {
                    @unlink($files);
                }
                try {
                    $slug = Str::slug($request->product_name, '-');
                    $Image = $slug . '-product-' . time() . '.' . $request->file('images')->guessExtension();
                    $path = '/images/product';
                    $request->file('images')->storeAs($path, $Image, 'public');
                    $data['images']  = $Image;
                } catch (\Exception $e) {
                    return back()->with('error', 'Could not upload your file', $e->getMessage());
                }
            }
            $data['category_id']        = $request['category_name'];
            $data['subcategory_id']     = $request['subcategory_name'];
            $data['product_name']       = $request['product_name'];
            $data['size']               = $request['size'];
            $data['price']              = $request['price'];
            $data['description']        = $request['description'];
            $data->update();
            return redirect()->route('product.index')->with('success', 'Product update successfully.');
        }
    }
}
