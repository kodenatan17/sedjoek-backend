<?php

use App\Http\Controllers\API\BrandProductController;
use App\Http\Controllers\API\UserController;
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

//Product API
Route::get('products', [App\Http\Controllers\API\ProductController::class], 'all'); //Routing untuk products
//Category product API
Route::get('categories', [App\Http\Controllers\API\ProductCategoryController::class], 'all'); //Routing untuk categoryproducts
//Brand product API
Route::get('brands', [BrandProductController::class, 'all']);
//User Controller API
Route::post('register', [UserController::class, 'register']); //register api
Route::post('login', [UserController::class, 'login']); //login api
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'fetch']); //function untuk fecth/get data user
    Route::get('user', [UserController::class, 'updateProfile']); //function untuk ubah data user
});
