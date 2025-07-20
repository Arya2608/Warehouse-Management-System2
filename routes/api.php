<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\StockMovementController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('categories', CategoryController::class);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('products', ProductController::class);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('warehouses', WarehouseController::class);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('inventories', InventoryController::class);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('stock-movements', StockMovementController::class)->only([
        'index', 'store', 'show'
    ]);
});



