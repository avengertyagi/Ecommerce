<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function userProfile()
    {
        return view('admin.profile.profile');
    }
    public function Updateprofile(Request $request)
    {
        $rules = [
            'name'     => ['required', 'max:20'],
            'country'  => ['required', 'max:20'],
            'email'    => ['required', 'regex:/(.+)@(.+)\.(.+)/i', 'max:150'],
            'mobile'    => ['required', 'regex:/^([6789]\d{9}$[0-9\s\-\+\(\)]*)$/', 'digits:10'],
            'address'   => ['required', 'max:100'],
            'image'     => ['nullable', 'mimes:jpeg,jpg,png', 'max:2000'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $getDetail = User::where('id', Auth::user()->id)->first();
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $privious_image = 'images' . $getDetail['image'];
                if (file_exists($privious_image)) {
                    @unlink($privious_image);
                }
                try {
                    $extension = $file->getClientoriginalExtension();
                    $destination = 'images';
                    $filename = rand(1111, 9999) . '.' . $extension;
                    $path = $request->image->move($destination, $filename);
                    $getDetail['image'] = $filename;
                } catch (\Exception $e) {
                    return back()->with('error', 'Could not upload your file', $e->getMessage());
                }
            }
            $getDetail['name']        = $request['name'];
            $getDetail['country']     = $request['country'];
            $getDetail['email']       = $request['email'];
            $getDetail['mobile']      = $request['mobile'];
            $getDetail['address']     = $request['address'];
            $getDetail['updated_at'];
            $getDetail->update();
            return back()->with('success', 'Profile update successfully.');
        }
    }
    public function changepassword(Request $request)
    {
        $data = $request->all();
        //check validate data
        $rules = [
            'current_password' => ['required', Password::min(8)],
            'new_password'     => ['required', Password::min(8)],
            'confirm_password' => ['same:new_password'],
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if (!Hash::check($data['current_password'], Auth::user()->password)) {
                return back()->with('error', 'Old password does not match.');
            } else {
                User::where('id', Auth::user()->id)->update(['password' => Hash::make($data['new_password'])]);
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('success', 'Password has been updated Successfully');
            }
        }
    }
}
