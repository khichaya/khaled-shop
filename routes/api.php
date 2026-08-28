<?php

use App\Http\Controllers\Api\ProductSyncController;
use App\Http\Controllers\Api\OrderStatusController;
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sync-product', [ProductSyncController::class, 'sync']);
    Route::post('/delete-product', [ProductSyncController::class, 'destroy']); // <--- إضافة هذا المسار
    Route::post('/update-order-status', [OrderStatusController::class, 'update']);

    });