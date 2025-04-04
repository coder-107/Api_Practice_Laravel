<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
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

// If you want to provide a custome/specific language to the any of the route then use bellow method:

Route::get('/greeting/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'es', 'fr'])) {
        abort(400);
    }

    App::setLocale($locale);
});

// Language Routes:

Route::get('lang/home', [LanguageController::class, 'index']);
Route::post('lang/change', [LanguageController::class, 'change'])->name('changeLang');

// helper Route :

Route::get('call-helpers', function () {

    // dd(
    //     $isAccessible = Arr::accessible(['a' => 1, 'b' => 2]),
    //     $isAccessible = Arr::accessible(new Collection),
    //     $isAccessible = Arr::accessible('abc'), // Not in array [].
    //     $isAccessible = Arr::accessible(new stdClass)
    // );

    // $myd = convertYmdToMdy('2025-04-03');
    // var_dump("converted into 'MYD' : ".$myd);

    // $ymd = convertMdyToYmd('04-03-2025');
    // var_dump("Converted into 'YMD': " . $ymd);

    // dd(
    //     $array = Arr::add(['name' => 'John'], 'lname', 'Doe'),
    //     $array = Arr::add(['name' => 'John', 'mname' => null], 'lname', 'Doe'),
    //     $array = Arr::add(['name' => 'John', 'mname' => null], 'lname', 'Doe')
    // );

    // dd($array = Arr::collapse([[1, 2, 3], [4, 5, 6], [7, 8, 9]]));

    // $matrix = Arr::crossJoin([1, 2], ['a', 'b'], ['I', 'II']);
    // return $matrix;

    // [$keys, $values] = Arr::divide(['name' => 'Desk']);
    // return [$keys, $values];

    // dd($array = [100, 200, 300],
 
    // $first = Arr::first($array, function (int $value, int $key) {
    //     return $value >= 150;
    // }));

    dd(
        $array = [
            ['product_id' => 'prod-200', 'name' => 'Desk'],
            ['product_id' => 'prod-100', 'name' => 'Chair'],
        ],
         
        $keyed = Arr::keyBy($array, 'product_id')
    );
});
