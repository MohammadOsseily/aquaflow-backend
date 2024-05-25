<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;

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

    Route::post("/getUser", [\App\Http\Controllers\UserController::class, "getUser"]);
    Route::post("/show", [\App\Http\Controllers\UserController::class, "show"]);
    Route::post("/checkexist", [\App\Http\Controllers\UserController::class, "checkExist"]);
    Route::post("/register", [\App\Http\Controllers\UserController::class, "register"]);
    Route::post("/login", [\App\Http\Controllers\UserController::class, "login"]);
    Route::post("/showcart", [\App\Http\Controllers\UserController::class, "cart"]);
});

Route::prefix('product')->group(function () {

    Route::post("/get/{id}", [\App\Http\Controllers\ProductController::class, "getproduct"]);
    Route::post("/delete/{id}", [\App\Http\Controllers\ProductController::class, "deleteproduct"]);
    Route::post("/edit/{id}", [\App\Http\Controllers\ProductController::class, "updateproduct"]);
    Route::post("/create", [\App\Http\Controllers\ProductController::class, "createproduct"]);

    Route::post("/productcat", [\App\Http\Controllers\ProductController::class, "productCategories"]);
    Route::post("/show", [\App\Http\Controllers\ProductController::class, "show"]);
    Route::post("/delete", [\App\Http\Controllers\ProductController::class, "destroy"]);
    Route::post('/update', [\App\Http\Controllers\ProductController::class, 'update']);
});


Route::post('/login', [UserController::class, 'login']);


Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
// routes/api.php

Route::post('/cart/add', [CartController::class, 'addToCart']);
Route::post('/cart', [CartController::class, 'getCart']);
Route::post('/cart/update', [CartController::class, 'updateCartItem']);
Route::post('/cart/remove', [CartController::class, 'removeCartItem']);
// routes/api.php
