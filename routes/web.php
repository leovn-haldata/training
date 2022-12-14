<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductsController::class);
    Route::post('products/storeMedia', [ProductsController::class, 'storeMedia'])->name('products.storeMedia');

    Route::resource('users', UsersController::class);
    Route::get('users/active/{id}', [UsersController::class, 'isActive'])->name('users.active');

    Route::resource('customers', CustomerController::class);

});

require __DIR__.'/auth.php';
