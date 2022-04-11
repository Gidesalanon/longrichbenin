<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\HomeController;
use App\http\controllers\UserController;
use App\http\controllers\CategoryController;
use App\http\controllers\ProductController;
use App\http\controllers\OrderController;
use App\http\controllers\StockController;
use App\http\controllers\UserManagementController;
use App\http\controllers\EnterpriseController;
use App\http\controllers\MagasinierController;
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

Route::group(['middleware' => ['auth','isUser']], function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::resource('/orders', OrderController::class);

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [UserController::class, 'administration'])->name('admin.home');
        /* Route::get('/users/{id}/editer', [UserController::class, 'editer'])->name('admin.use    rs.editer'); */
        Route::resource('users', UserController::class);
        Route::resource('usermanagements', UserManagementController::class);
        Route::get('/usermanagements/{user_id}/disable', [UserManagementController::class, 'isNotBan'])->name('admin.users.disable');
        Route::get('/usermanagements/{user_id}/enable', [UserManagementController::class, 'isBan'])->name('admin.users.enable');
        //crud category
        Route::resource('admin/categories', CategoryController::class);
        Route::resource('admin/enterprises', EnterpriseController::class);
        Route::resource('admin/products', ProductController::class);
        /* Route::resource('admin/stocks', StockController::class); */

        Route::get('/order', [OrderController::class, 'orderIndex'])->name('admin.order.index');
        Route::get('/orders/{order_id}/orderApprove', [OrderController::class, 'approveOrder'])->name('admin.orders.approve');
        Route::get('/orders/{order_id}/oneApprove', [OrderController::class, 'approveOneOrder'])->name('admin.orders.Oneapprove');
        Route::get('/orders/{order_id}/desaprove', [OrderController::class, 'desapproveOrder'])->name('admin.orders.desapprove');
        Route::get('/orders/{order_id}/oneDesaprove', [OrderController::class, 'desapproveOneOrder'])->name('admin.orders.Onedesapprove');
        Route::get('orders/{order_id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::patch('orders/{order_id}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{ordergroup_id}/destroy', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/orders/{order_id}/destroy', [OrderController::class, 'destrLineOrder'])->name('lineOrder.destroy');

        Route::delete('/order/{ordergroup_id}/destroy', [OrderController::class, 'destroyOrder'])->name('admin.order.destroy');
        Route::get('/order/{order_id}/destroy', [OrderController::class, 'destroyLineOrder'])->name('admin.lineOrder.destroy');
        Route::get('orderedit/{order_id}/edit', [OrderController::class, 'editOrder'])->name('order.edit');
        Route::patch('orderedit/{order_id}', [OrderController::class, 'updateOrder'])->name('order.update');
    });

    Route::middleware(['magasinier', 'admin'])->group(function () {
        Route::resource('magasiniers', MagasinierController::class);
    });

});
