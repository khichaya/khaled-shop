<?php
use App\Http\Controllers\Api\CarCatalogSyncController;
use App\Http\Controllers\Api\ProductSyncController;
use App\Http\Controllers\Api\OrderStatusController;
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sync-product', [ProductSyncController::class, 'sync']);
    Route::post('/delete-product', [ProductSyncController::class, 'destroy']); // <--- إضافة هذا المسار
    Route::post('/update-order-status', [OrderStatusController::class, 'update']);
    Route::post('/sync-car-catalog', [CarCatalogSyncController::class, 'sync']);
    });