<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\HomeController as ControllersHomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/submitlogin', [LoginController::class, 'submitLogin'])->name('submitlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::controller(HomeController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
    Route::get('profile','userProfile')->name('profile');
    Route::post('updateProfile','Updateprofile')->name('updateProfile');
    Route::post('changepassword','changepassword')->name('changepassword');
});
Route::resource('category',CategoryController::class);
