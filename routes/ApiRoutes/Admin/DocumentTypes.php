<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Settings\DocumentTypeController;

//All document type route
Route::prefix('documenttype')->group(function () {
    Route::get('/', [DocumentTypeController::class, 'get']);
    Route::post('/', [DocumentTypeController::class, 'store']);
    Route::prefix('/{documenttype}')->group(function () {
        Route::put('/', [DocumentTypeController::class, 'update']);
        Route::delete('/', [DocumentTypeController::class, 'destroy']);
        Route::prefix('/title/{documenttypetitle}')->group(function () {
            Route::put('/', [DocumentTypeController::class, 'updateDocumentTypeTitle']);
            Route::delete('/', [DocumentTypeController::class, 'destroyDocumentTypeTitle']);
        });
    });
});
