<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $module_data = Category::select('id', 'name', 'status','created_at')->get();
        return view('admin.category.index', compact('module_data'));
    }
    public function create()
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        return view('admin.category.create',compact('categories'));
    }
    public function store(Request $request)
    {
        $rules = [
            'name'     => ['required', 'max:20'],
            'parent_id'=> ['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $data                = new Category();
            $data['name']        = $request['name'];
            $data['parent_id']   = $request['parent_id'];
            $data->save();
            return redirect()->route('category.index')->with('success', 'Category saved successfully.');
        }
    }
    public function status($id)
    {
        $status = Category::where('id', $id)->first();
        if ($status->status == '1') {
            $status   = '0';
        } else {
            $status   = '1';
        }
        Category::where('id', $id)->update(['status' => $status]);
        return back()->with('success', 'Status update successfully.');
    }
    public function destroy($id)
    {
        $data = Category::find($id);
        $data->delete();
        return back()->with('success', 'Deleled Successfully.');
    }
    public function show($id)
    {
        $data = Category::find($id);
        return view('admin.category.show');
    }
    public function edit($id)
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        $data = Category::find($id);
        return view('admin.category.edit', compact('data','categories'));
    }
    public function update(Request $request,$id)
    {
        $rules = [
            'name'     => ['required', 'max:20'],
            'parent_id' =>['required'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $data                = Category::find($id);
            $data['name']        = $request['name'];
            $data['parent_id']   = $request['parent_id'];
            $data->update();
            return redirect()->route('category.index')->with('success', 'Category update successfully.');
        }
    }
}
