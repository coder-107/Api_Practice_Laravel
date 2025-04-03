<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.home');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    // Route::get('/blogs', [PostController::class, 'index'])->name('blog.home');
    // Route::get('/blogs/create', [PostController::class, 'create'])->name('blog.create');
    // Route::post('/blogs', [PostController::class, 'store'])->name('blog.store');
    // Route::get('/blogs/edit/{id}', [PostController::class, 'edit'])->name('blog.edit');
    // Route::get('/blogs/show/{id}', [PostController::class, 'show'])->name('blog.show');
    // Route::delete('/blogs/delete/{id}', [PostController::class, 'delete'])->name('blog.delete');
    // Route::put('/blogs/update/{id}', [PostController::class, 'update'])->name('blog.update');
});

// Request Validation Practice :

Route::get('/blogs', [PostController::class, 'index'])->name('blog.home');
Route::get('/blogs/create', [PostController::class, 'create'])->name('blog.create');
Route::post('/blogs', [PostController::class, 'store'])->name('blog.store');
Route::get('/blogs/edit/{id}', [PostController::class, 'edit'])->name('blog.edit');
Route::get('/blogs/show/{id}', [PostController::class, 'show'])->name('blog.show');
Route::delete('/blogs/delete/{id}', [PostController::class, 'delete'])->name('blog.delete');
Route::put('/blogs/update/{id}', [PostController::class, 'update'])->name('blog.update');


Route::group(['middleware' =>  ['role:user|admin|Editor']], function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.home');
    Route::get('/user/product', [UserProductController::class, 'index'])->name('product');
});
