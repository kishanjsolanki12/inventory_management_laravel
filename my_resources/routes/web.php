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
Route::get('/admin/users/fetch_data', [App\Http\Controllers\Admin\UserController::class, 'fetch_data'])->name('fetch_data');
Route::get('/admin/users/get_state', [App\Http\Controllers\Admin\UserController::class, 'get_state'])->name('get_state');
Route::get('/admin/users/get_city', [App\Http\Controllers\Admin\UserController::class, 'get_city'])->name('get_city');
Route::get('/admin/users/get_area', [App\Http\Controllers\Admin\UserController::class, 'get_area'])->name('get_area');

Route::prefix('admin')->middleware(['auth', 'admin.auth'])->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    //user
    Route::get   ('/users/{id}/show', 'App\Http\Controllers\Admin\UserController@show')->name('users.show');
    Route::resource('/users', 'App\Http\Controllers\Admin\UserController')->name('*', 'users');

    
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
