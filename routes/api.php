<?php

use App\Http\Controllers\Api\AuthTokensController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\MainCategoriesController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' =>['auth:sanctum']],function(){
    
    Route::post('/logout', [AuthController::class,'logout']);

});
//Auht
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
//Generall
Route::resource('items' , ItemController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('main_categories', MainCategoriesController::class);
Route::apiResource('items', ItemController::class);
//Wishlist and cart
Route::resource('wishlists' , WishlistController::class);
Route::delete('/wishlists/delete' , [CartController::class , 'destroy']);
Route::resource('carts' , CartController::class);
Route::delete('/carts/delete' , [CartController::class , 'destroy']);
//notifications and orders
Route::apiResource('notifications', NotificationsController::class);
Route::apiResource('orders', OrdersController::class);