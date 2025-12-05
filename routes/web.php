<?php


use Illuminate\Support\Facades\Route;
//  WEB
use App\Http\Controllers\Web\CategoryController as WebCategoryController;

// ADMIN
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;


Route::get('/', function () {
    return view('web.home.index');
});

// Admin Routes : middleware(['auth' , 'admin'])
Route::prefix('admin')->middleware([])->group(function () {
    Route::resource('dashboard', AdminDashboardController::class)
        ->names([
            'index' => 'admin.dashboard.index',
            'create' => 'admin.dashboard.create',
            'store' => 'admin.dashboard.store',
            'show' => 'admin.dashboard.show',
            'edit' => 'admin.dashboard.edit',
            'update' => 'admin.dashboard.update',
            'destroy' => 'admin.dashboard.destroy',
        ]);
    Route::resource('users', AdminUserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    Route::resource('accounts', AdminAccountController::class)->names([
        'index' => 'admin.accounts.index',
        'create' => 'admin.accounts.create',
        'store' => 'admin.accounts.store',
        'show' => 'admin.accounts.show',
        'edit' => 'admin.accounts.edit',
        'update' => 'admin.accounts.update',
        'destroy' => 'admin.accounts.destroy',
    ]);
    Route::resource('categories', AdminCategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);
    Route::resource('orders', AdminOrderController::class)->names([
        'index' => 'admin.orders.index',
        'create' => 'admin.orders.create',
        'store' => 'admin.orders.store',
        'show' => 'admin.orders.show',
        'edit' => 'admin.orders.edit',
        'update' => 'admin.orders.update',
        'destroy' => 'admin.orders.destroy',
    ]);
    Route::resource('homepage', AdminOrderController::class)->names([
        'index' => 'admin.homepage.index',
        'create' => 'admin.homepage.create',
        'store' => 'admin.homepage.store',
        'show' => 'admin.homepage.show',
        'edit' => 'admin.homepage.edit',
        'update' => 'admin.homepage.update',
        'destroy' => 'admin.homepage.destroy',
    ]);
});

// Route::prefix('web')->group(function () {
//     Route::resource('categories', WebCategoryController::class);
// });
