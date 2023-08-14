<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/get_entry', [App\Http\Controllers\API\AttendenceController::class, 'get_entry']);
Route::post('/get_payout', [App\Http\Controllers\API\AttendenceController::class, 'get_payout']);
Route::post('/login_verify_user', [App\Http\Controllers\API\AuthController::class,'LoginVerifyUser']);
Route::post('/user_verify_sms', [App\Http\Controllers\API\AuthController::class,'UserVerifySMS']);
Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
Route::post('/account_delete', [App\Http\Controllers\API\AuthController::class, 'account_delete']);

// Home Api
Route::post('/home_api', [App\Http\Controllers\API\SpeedyApiController::class, 'home_api']);
// category list top 10
Route::GET('/category_list', [App\Http\Controllers\API\SpeedyApiController::class, 'category_list']);

// category list All
Route::GET('/category_list_all', [App\Http\Controllers\API\SpeedyApiController::class, 'category_list_all']);

// offers list All
Route::GET('/offers', [App\Http\Controllers\API\SpeedyApiController::class, 'offers']);
Route::GET('/offers_details', [App\Http\Controllers\API\SpeedyApiController::class, 'offers_details']);

// product_list_by_category
Route::GET('/product_list_by_category', [App\Http\Controllers\API\SpeedyApiController::class, 'product_list_by_category']);

// Product List 
Route::GET('/product_list', [App\Http\Controllers\API\SpeedyApiController::class, 'product_list']);
Route::GET('/product_detail', [App\Http\Controllers\API\SpeedyApiController::class, 'product_detail']);
Route::post('/product_search', [App\Http\Controllers\API\SpeedyApiController::class, 'product_search']);
Route::post('/product_search_rating', [App\Http\Controllers\API\SpeedyApiController::class, 'product_search_rating']);

// brand list
Route::GET('/brand_list', [App\Http\Controllers\API\SpeedyApiController::class, 'brand_list']);

// Add wishlist

Route::post('/add_wishlist', [App\Http\Controllers\API\SpeedyApiController::class, 'add_wishlist']);
Route::post('/wishlist_detail', [App\Http\Controllers\API\SpeedyApiController::class, 'wishlist_detail']);
Route::post('/remove_wishlist', [App\Http\Controllers\API\SpeedyApiController::class, 'remove_wishlist']);

// Add review
Route::post('/add_review', [App\Http\Controllers\API\SpeedyApiController::class, 'add_review']);
Route::GET('/list_of_review', [App\Http\Controllers\API\SpeedyApiController::class, 'list_of_review']);
Route::GET('/review_detail', [App\Http\Controllers\API\SpeedyApiController::class, 'review_detail']);

// Add to Cart
Route::post('/add_to_cart', [App\Http\Controllers\API\SpeedyApiController::class, 'add_to_cart']);
Route::post('/remove_add_to_cart', [App\Http\Controllers\API\SpeedyApiController::class, 'remove_add_to_cart']);

// Add Address
Route::post('/add_address', [App\Http\Controllers\API\SpeedyApiController::class, 'add_address']);
Route::GET('/list_of_address', [App\Http\Controllers\API\SpeedyApiController::class, 'list_of_address']);

// Add Contact us
Route::post('/contact_us', [App\Http\Controllers\API\SpeedyApiController::class, 'contact_us']);

// order management
Route::post('/order_manager', [App\Http\Controllers\API\SpeedyApiController::class, 'order_manager']);
Route::GET('/order_listing', [App\Http\Controllers\API\SpeedyApiController::class, 'order_listing']);



Route::resource('attendence', App\Http\Controllers\API\AttendenceController::class);


//Protecting Routes
/*Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::resource('attendence', App\Http\Controllers\API\AttendenceController::class);

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});*/