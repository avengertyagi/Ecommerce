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
Route::controller(CategoryController::class)->group(function () {
    Route::get('category/list', 'index')->name('category.index');
    Route::get('category/create', 'create')->name('category.create');
    Route::post('category/store', 'store')->name('category.store');
    Route::get('category/edit/{id}', 'edit')->name('category.edit');
    Route::post('category/upadte/{id}', 'update')->name('category.update');
    Route::delete('category/delete/{id}', 'destroy')->name('category.destroy');
    Route::get('category/update/status/{id}', 'status')->name('category.status');
});

//subcategory
Route::controller(SubcategoryController::class)->group(function () {
    Route::get('subcategory/list', 'index')->name('subcategory.index');
    Route::get('subcategory/create', 'create')->name('subcategory.create');
    Route::post('subcategory/store', 'store')->name('subcategory.store');
    Route::get('subcategory/edit/{id}', 'edit')->name('subcategory.edit');
    Route::post('subcategory/update/{id}', 'update')->name('subcategory.update');
    Route::get('subcategory/delete/{id}', 'destroy')->name('subcategory.destroy');
    Route::get('subcategory/update/status/{id}', 'status')->name('subcategory.status');
});

//product
Route::controller(ProductController::class)->group(function () {
    Route::get('product/list', 'index')->name('product.index');
    Route::get('product/create', 'create')->name('product.create');
    Route::post('product/store', 'store')->name('product.store');
    Route::get('product/edit/{id}', 'edit')->name('product.edit');
    Route::post('product/update/{id}', 'update')->name('product.update');
    Route::get('product/update/status/{id}', 'status')->name('product.status');
    Route::delete('product/delete/{id}', 'destroy')->name('product.destroy');
});

//city
Route::resource('city', CityController::class); //
Route::controller(CityController::class)->group(function () {
    Route::get('city/table/list', 'datatables')->name('city.datatables');
    Route::get('city/search', 'citySearch')->name('city.citySearch');
});
