<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [App\Http\Controllers\API\ProductController::class], 'all'); //Routing untuk products
Route::get('/categories', [App\Http\Controllers\API\ProductCategoryController::class], 'all'); //Routing untuk categoryproducts
//User Controller API
Route::get('register', [UserController::class, 'register']);