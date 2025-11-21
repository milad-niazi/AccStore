<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


route::apiResource('users', UserController::class);
route::apiResource('accounts', AccountController::class);
