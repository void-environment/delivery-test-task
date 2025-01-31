<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::post('/couriers', [CourierController::class, 'store']);
    Route::get('/couriers/{id}', [CourierController::class, 'show']);
    Route::patch('/couriers/{id}', [CourierController::class, 'update']);

    Route::prefix('orders')->group(function () {
        Route::post('/', [OrderController::class, 'store']);
        Route::post('/assign', [OrderController::class, 'assign']);
        Route::post('/complete', [OrderController::class, 'complete']);
    });
});