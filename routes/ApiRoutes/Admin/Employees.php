<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\EmployeeController;

//Employee routes
Route::prefix('employees')->group(function () {
    Route::get('/', [EmployeeController::class, 'get']);
    Route::post('/', [EmployeeController::class, 'store']);
    Route::prefix('/{user}')->group(function () {
        Route::get('/', [EmployeeController::class, 'getSelectedEmployee']);
        Route::put('/', [EmployeeController::class, 'update']);
    });
});
