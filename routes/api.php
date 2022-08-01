<?php

use App\Http\Controllers\API\BrandProductController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductCategoryController;
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
Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'all');
});
//Category product API
Route::controller(ProductCategoryController::class)->group(function () {
    Route::get('/categories', 'all');
});
//Brand product API
Route::controller(BrandProductController::class)->group(function () {
    Route::get('/brands', 'all');
});
//User Controller API
Route::controller(UserController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'fetch']); //function untuk fecth/get data user
    Route::post('user', [UserController::class, 'updateProfile']); //function untuk ubah data user
    Route::post('logout', [UserController::class, 'logout']); //function untul logout user
    Route::get('transaction', [TransactionController::class, 'all']); //function untuk transaction controller
    Route::post('checkout', [TransactionController::class, 'checkout']); //function untuk transaction checkout
});
