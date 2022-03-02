<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\HomeController;
use App\http\controllers\UserController;
use App\http\controllers\CategoryController;
use App\http\controllers\ProductController;
use App\http\controllers\OrderController;
use App\http\controllers\StockController;
use App\Models\Task;
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
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/approval', [HomeController::class, 'approval'])->name('approval');

    Route::middleware(['approved'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::post('orders', [OrderController::class, 'store']);
        Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [UserController::class, 'administration'])->name('admin.home');
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user_id}/approve', [UserController::class, 'approve'])->name('admin.users.approve');
        Route::delete('/users/{user_id}/destroy', [UserController::class, 'destroy'])->name('admin.users.destroy');

        //crud category
        Route::resource('admin/categories', CategoryController::class);
        Route::resource('admin/products', ProductController::class);
        Route::resource('admin/stocks', StockController::class);
    });
});
