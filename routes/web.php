<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\HomeController as ControllersHomeController;

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
    Route::get('profile', 'userProfile')->name('profile');
    Route::post('updateProfile', 'Updateprofile')->name('updateProfile');
    Route::post('changepassword', 'changepassword')->name('changepassword');
});
//category
Route::resource('category', CategoryController::class);
Route::get('category/update/status/{id}', [CategoryController::class, 'status']);

//subcategory
Route::resource('subcategory', SubcategoryController::class);
Route::get('subcategory/update/status/{id}', [SubcategoryController::class, 'status']);

//product
Route::resource('product', ProductController::class);
Route::get('product/update/status/{id}', [ProductController::class, 'status']);

//city
Route::resource('city', CityController::class);
Route::get('city/table/list', [CityController::class, 'datatables']);
