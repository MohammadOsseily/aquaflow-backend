<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('user')->group(function () {

    Route::post("/view", [\App\Http\Controllers\UserController::class, "show"]);
});

Route::prefix('product')->group(function () {

    Route::post("/view", [\App\Http\Controllers\ProductController::class, "show"]);
    Route::post("/delete", [\App\Http\Controllers\ProductController::class, "destroy"]);
    Route::post('/update', [\App\Http\Controllers\ProductController::class, 'update']);
});
