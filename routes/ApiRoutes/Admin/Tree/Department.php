<?php

use App\Http\Controllers\Admin\Tree\DepartmentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Profile\DocumentController;

//All department routes
Route::prefix('department')->group(function () {
    Route::post('/', [DepartmentController::class, 'add']);
    Route::prefix('/{department}')->group(function () {
        Route::get('/', [DepartmentController::class, 'get']);
        Route::put('/', [DepartmentController::class, 'update']);
        //All position routes
        Route::prefix('/position')->group(function () {
            Route::get('/', [DepartmentController::class, 'getPositions']);
            Route::post('/', [DepartmentController::class, 'addPosition']);
            Route::prefix('/{position}')->group(function () {
                Route::put('/', [DepartmentController::class, 'updatePosition']);
                Route::delete('/', [DepartmentController::class, 'deletePosition']);
                //All position title routes
                Route::prefix('/title/{positiontitle}')->group(function () {
                    Route::delete('/', [DepartmentController::class, 'deletePositionTitle']);
                    Route::put('/', [DepartmentController::class, 'updatePositionTitle']);
                });
            });
        });
    });
});
