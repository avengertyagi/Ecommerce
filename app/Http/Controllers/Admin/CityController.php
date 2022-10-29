<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class CityController extends Controller
{
    public function index()
    {
        return view('admin.city.index');
    }
    public function datatables(Request $request)
    {
        $details = City::orderBy('id', 'DESC');
        return Datatables::of($details)
            ->addIndexColumn()
            ->make(true);
    }
    public function citySearch(Request $request)
    {
        if ($request->has('search')) {
            $details = City::search($request->input('search'))->toArray();
        }
        return view('admin.city.index', compact('details'));
    }
}
