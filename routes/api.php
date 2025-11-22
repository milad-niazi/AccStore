<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\TransactionController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

route::apiResource('users', UserController::class);
route::apiResource('accounts', AccountController::class);
route::apiResource('categories', CategoryController::class);
route::apiResource('orders', OrderController::class);
route::apiResource('order-items', OrderItemController::class);
route::apiResource('transactions', TransactionController::class);
