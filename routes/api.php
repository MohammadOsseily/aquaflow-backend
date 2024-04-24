<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
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

    Route::post("/show", [\App\Http\Controllers\UserController::class, "show"]);
    Route::post("/checkexist", [\App\Http\Controllers\UserController::class, "checkExist"]);
    Route::post("/register", [\App\Http\Controllers\UserController::class, "register"]);
    Route::post("/login", [\App\Http\Controllers\UserController::class, "login"]);
    Route::post("/showcart", [\App\Http\Controllers\UserController::class, "cart"]);
});

Route::prefix('product')->group(function () {

    Route::post("/productcat", [\App\Http\Controllers\ProductController::class, "productCategories"]);
    Route::post("/show", [\App\Http\Controllers\ProductController::class, "show"]);
    Route::post("/delete", [\App\Http\Controllers\ProductController::class, "destroy"]);
    Route::post('/update', [\App\Http\Controllers\ProductController::class, 'update']);
});


Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');


Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
// routes/api.php
