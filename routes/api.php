<?php

use App\Http\Controllers\API\Admin\ManageProductAPIController;
use App\Http\Controllers\API\Admin\ManageRolesController;
use App\Http\Controllers\API\Admin\ManageUserController;
use App\Http\Controllers\API\apiProductController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route::apiResource("products", ProductController::class);
Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function(){

    Route::group(['middleware' => ['role:admin']], function(){
        Route::resource('products-manage', ManageProductAPIController::class);
        Route::resource('roles-manage', ManageRolesController::class);
        Route::resource('users-manage', ManageUserController::class);
    });

    Route::group(['middleware' => ['role:user']], function(){
        Route::resource('products', apiProductController::class);
    });

    Route::post('logout', [AuthController::class, 'logout']);
});
