<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
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

route::post('register', [UserController::class, 'register']);
route::post('login', [UserController::class, 'login']);


Route::group(['middleware' => ["auth:sanctum"]], function () {
    //rutas
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);
    route::post('insertCategory', [CategoryController::class, 'insertCategory']);
    Route::post('destroyCategory', [CategoryController::class, 'destroyCategory']);
    Route::post('updateCategory', [CategoryController::class, 'updateCategory']);
    Route::post('readCategory', [CategoryController::class, 'readCategory']);

    route::post('insertProduct', [ProductController::class, 'insertProduct']);
    Route::post('destroyProduct', [ProductController::class, 'destroyProduct']);
    Route::post('updateProduct', [ProductController::class, 'updateProduct']);
    Route::post('readProduct', [ProductController::class, 'readProduct']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
