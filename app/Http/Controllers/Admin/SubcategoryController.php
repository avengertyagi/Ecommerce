<?php

namespace App\Http\Controllers\Admin;

use App\Models\category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
{
    public function index()
    {
        $module_data = Subcategory::select('id', 'name', 'status', 'created_at')->get();
        return view('admin.subcategory.index', compact('module_data'));
    }
    public function create()
    {
        $sub_categories = Subcategory::where('parent_id', null)->orderby('name', 'asc')->get();
        $category = Category::select('id', 'name', 'status')->where('status', '1')->get();
        return view('admin.subcategory.create', compact('category','sub_categories'));
    }
    public function store(Request $request)
    {
        $rules = [
            'category_name'  => ['required'],
            'parent_id'      => ['required'],
            'name'           => ['required', 'max:20'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $data                    = new Subcategory();
            $data['name']            = $request['name'];
            $data['category_id']     = $request['category_name'];
            $data['parent_id']       = $request['parent_id'];
            $data->save();
            return redirect('subcategory')->with('success', 'Subcategory saved successfully.');
        }
    }
    public function status($id)
    {
        $status = Subcategory::where('id', $id)->first();
        if ($status->status == '1') {
            $status   = '0';
        } else {
            $status   = '1';
        }
        Subcategory::where('id', $id)->update(['status' => $status]);
        return back()->with('success', 'Status update successfully.');
    }
    public function destroy($id)
    {
        $data = Subcategory::find($id);
        $data->delete();
        return back()->with('success', 'Deleled Successfully.');
    }
    public function edit($id)
    {
        $sub_categories = Subcategory::where('parent_id', null)->orderby('name', 'asc')->get();
        $data = Subcategory::with('categories')->find($id);
        $category = Category::select('id', 'name', 'status')->where('status', '1')->get();
        return view('admin.subcategory.edit', compact('data', 'category','sub_categories'));
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'category_name'  => ['required'],
            'name'           => ['required', 'max:20'],
            'parent_id'      => ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $data                    = Subcategory::find($id);
            $data['name']            = $request['name'];
            $data['category_id']     = $request['category_name'];
            $data['parent_id']       = $request['parent_id'];
            $data->update();
            return redirect()->route('subcategory.index')->with('success', 'Subcategory saved successfully.');
        }
    }
}
