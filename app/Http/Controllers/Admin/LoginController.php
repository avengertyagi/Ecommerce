<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }
    public function submitLogin(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'type' => 'admin'])) {
            return  redirect()->route('dashboard')->with('success', 'Login Successfully.');
        } else {
            return back()->with('error', 'Invalid Credentials.');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout Successfully.');
    }
}
