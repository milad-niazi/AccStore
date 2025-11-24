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
    return view('welcome');
});

// Admin Routes : middleware(['auth' , 'admin'])
Route::prefix('admin')->middleware([])->group(function () {
    Route::resource('dashboard', AdminDashboardController::class)
        ->names([
            'index' => 'admin.dashboard.list',
            'create' => 'admin.dashboard.add',
            'store' => 'admin.dashboard.store',
            'show' => 'admin.dashboard.view',
            'edit' => 'admin.dashboard.edit',
            'update' => 'admin.dashboard.update',
            'destroy' => 'admin.dashboard.delete',
        ]);
    Route::resource('users', AdminUserController::class)->names([
        'index' => 'admin.users.list',
        'create' => 'admin.dashboard.add',
        'store' => 'admin.dashboard.store',
        'show' => 'admin.dashboard.view',
        'edit' => 'admin.dashboard.edit',
        'update' => 'admin.dashboard.update',
        'destroy' => 'admin.dashboard.delete',
    ]);
    Route::resource('accounts', AdminAccountController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('orders', AdminOrderController::class);
});

// Route::prefix('web')->group(function () {
//     Route::resource('categories', WebCategoryController::class);
// });
