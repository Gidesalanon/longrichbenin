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
use App\http\controllers\SellingController;
use App\http\controllers\ProfileController;
use App\http\controllers\WelcomeController;
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

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::resource('/', WelcomeController::class);

Auth::routes();

Route::group(['middleware' => ['auth','isUser']], function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::resource('/orders', OrderController::class);
        Route::get('/order/situation', [OrderController::class, 'orderSituation'])->name('orders.situation');
        Route::resource('sellings', SellingController::class);
        Route::get('/selling/{id}/ecart', [SellingController::class, 'ecartPaie'])->name('ecart.paie');
        Route::resource('profiles', ProfileController::class);

        Route::get('profile/personnal/details', [ProfileController::class, 'editDetail'])->name('details.edit');
        Route::patch('profile/personnal/details', [ProfileController::class, 'updateDetail'])->name('details.update');

        Route::get('profile/password/edit', [ProfileController::class, 'editPassword'])->name('pwd.edit');
        Route::patch('profile/password/edit', [ProfileController::class, 'updatePassword'])->name('pwd.update');

        Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [UserController::class, 'administration'])->name('admin.home');

        Route::resource('users', UserController::class);
        Route::resource('usermanagements', UserManagementController::class);
        Route::get('/usermanagement/network', [UserManagementController::class, 'network'])->name('admin.users.network');
        Route::get('/usermanagements/{user_id}/disable', [UserManagementController::class, 'isNotBan'])->name('admin.users.disable');
        Route::get('/usermanagements/{user_id}/enable', [UserManagementController::class, 'isBan'])->name('admin.users.enable');
        Route::resource('admin/categories', CategoryController::class);
        Route::resource('admin/enterprises', EnterpriseController::class);
        Route::resource('admin/products', ProductController::class);
        Route::patch('admin/product/{id}', [ProductController::class, 'addStock'])->name('product.addstock');
        Route::get('/input/product/', [ProductController::class, 'inputProduct'])->name('admin.input.product');
        Route::get('/output/product/', [ProductController::class, 'outputProduct'])->name('admin.output.product');
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

        /* Route order administrateur */
        Route::delete('admin/order/{ordergroup_id}/destroy', [OrderController::class, 'destroyOrder'])->name('admin.order.destroy');
        Route::get('admin/order/{order_id}/destroy', [OrderController::class, 'destroyLineOrder'])->name('admin.lineOrder.destroy');
        Route::get('admin/orderedit/{order_id}/edit', [OrderController::class, 'editOrder'])->name('order.edit');
        Route::patch('admin/orderedit/{order_id}', [OrderController::class, 'updateOrder'])->name('order.update');
    });

    Route::middleware(['magasinier'])->group(function () {
        Route::get('/manager', [MagasinierController::class, 'manager'])->name('manager');
        Route::get('manager/order-approved', [MagasinierController::class, 'order'])->name('order.approved.index');
        Route::get('/orders/{order_id}/execute', [MagasinierController::class, 'execute'])->name('manager.orders.execute');
        Route::get('/orders/{order_id}/unExecute', [MagasinierController::class, 'unExecute'])->name('manager.orders.unExecute');
    });
});
