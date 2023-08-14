<?php

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
// Route::get('/', function () {
//     return view('welcome');
// });
//cron
//Route::get('/GetInFile', [App\Http\Controllers\CronController::class, 'GetInFile'])->name('GetInFile');
Route::get('/getsoketdata', function () {
       event(new \App\Events\MessagePushed());
       dd('Event run sucessfully');
    });
Route::get('/admin/users/fetch_data', [App\Http\Controllers\Admin\UserController::class, 'fetch_data'])->name('fetch_data');
Route::get('/admin/users/get_state', [App\Http\Controllers\Admin\UserController::class, 'get_state'])->name('get_state');
Route::get('/admin/users/get_city', [App\Http\Controllers\Admin\UserController::class, 'get_city'])->name('get_city');
Route::get('/admin/users/get_area', [App\Http\Controllers\Admin\UserController::class, 'get_area'])->name('get_area');

// Admin User
Route::get('/admin/admin_user/fetch_data', [App\Http\Controllers\Admin\AdminUserController::class, 'fetch_data'])->name('fetch_data');

// Vendor User
Route::get('/admin/vendor_management/fetch_data', [App\Http\Controllers\Admin\VendorController::class, 'fetch_data'])->name('fetch_data');

// suplliers
Route::get('/admin/supplier/fetch_data', [App\Http\Controllers\Admin\SupplierController::class, 'fetch_data'])->name('fetch_data');


// category
Route::get('/admin/category/fetch_data', [App\Http\Controllers\Admin\CategoryController::class, 'fetch_data'])->name('fetch_data');

// Product management
Route::get('/admin/product_management/fetch_data', [App\Http\Controllers\Admin\ProductController::class, 'fetch_data'])->name('fetch_data');
// Product management

Route::get('/admin/product_purchase/fetch_data', [App\Http\Controllers\Admin\ProductPurchaseController::class, 'fetch_data'])->name('fetch_data');
Route::get('/admin/product_purchase/product_purchase_amount', [App\Http\Controllers\Admin\ProductPurchaseController::class, 'product_purchase_amount'])->name('product_purchase_amount');
Route::get('/admin/product_purchase/final_amount', [App\Http\Controllers\Admin\ProductPurchaseController::class, 'final_amount'])->name('final_amount');

// product sell
Route::get('/admin/product_sell/fetch_data', [App\Http\Controllers\Admin\ProductSellController::class, 'fetch_data'])->name('fetch_data');
Route::get('/admin/product_sell/product_sell_amount', [App\Http\Controllers\Admin\ProductSellController::class, 'product_sell_amount'])->name('product_sell_amount');
Route::get('/admin/product_sell/final_amount', [App\Http\Controllers\Admin\ProductSellController::class, 'final_amount'])->name('final_amount');
Route::prefix('admin')->middleware(['auth', 'admin.auth'])->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    //user
    Route::get   ('/users/{id}/show', 'App\Http\Controllers\Admin\UserController@show')->name('users.show');
    Route::resource('/users', 'App\Http\Controllers\Admin\UserController')->name('*', 'users');

    // Admin Users

    Route::get('/admin_user/{id}/show', 'App\Http\Controllers\Admin\AdminUserController@show')->name('admin_user.show');
    Route::resource('/admin_user', 'App\Http\Controllers\Admin\AdminUserController')->name('*', 'admin_user');

    // Vendor Users

    Route::get('/vendor_management/{id}/show', 'App\Http\Controllers\Admin\VendorController@show')->name('vendor_management.show');
    Route::resource('/vendor_management', 'App\Http\Controllers\Admin\VendorController')->name('*', 'vendor_management');

    // product_purchase


    Route::resource('/product_purchase', 'App\Http\Controllers\Admin\ProductPurchaseController')->name('*', 'product_purchase');

    //Product Sell
    Route::resource('/product_sell', 'App\Http\Controllers\Admin\ProductSellController')->name('*', 'product_sell');

     // category

    Route::get('/category/{id}/show', 'App\Http\Controllers\Admin\CategoryController@show')->name('category.show');
    Route::resource('/category', 'App\Http\Controllers\Admin\CategoryController')->name('*', 'category');



    // Product management

    Route::get('/product_management/{id}/show', 'App\Http\Controllers\Admin\ProductController@show')->name('product_management.show');
    Route::resource('/product_management', 'App\Http\Controllers\Admin\ProductController')->name('*', 'product_management');
    Route::get('/product_management/delete_id', 'App\Http\Controllers\Admin\ProductController@delete_image')->name('product_management.delete_image');

     // category

     Route::get('/supplier/{id}/show', 'App\Http\Controllers\Admin\SupplierController@show')->name('supplier.show');
     Route::resource('/supplier', 'App\Http\Controllers\Admin\SupplierController')->name('*', 'supplier');


   // category

   Route::get('/report/fetch_data', [App\Http\Controllers\Admin\ReportController::class, 'fetch_data'])->name('fetch_data');
//    Route::get('/report/{id}/show', 'App\Http\Controllers\Admin\ReportController@show')->name('report.show');
   Route::resource('/report', 'App\Http\Controllers\Admin\ReportController')->name('*', 'report');






});

/*Route::prefix('yusen')->middleware(['auth', 'yusen.auth'])->group(function () {

    Route::get('/', function () {
        return view('yusen.dashboard');
    })->name('yusen');


});*/
/* Route::get('/', function () {
        return view('home');
    })->name('home');*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/demoupload', [App\Http\Controllers\CronController::class, 'demoupload'])->name('demoupload');

/*Route::prefix('/')->middleware(['auth','customer.auth'])->group(function () {

});
*/
require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
