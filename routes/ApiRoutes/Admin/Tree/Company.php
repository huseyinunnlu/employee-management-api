<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Tree\CompanyController;

//All company routes
Route::prefix('company')->group(function () {
    Route::post('/', [CompanyController::class, 'add']);
    Route::prefix('/{company}')->group(function () {
        Route::get('/', [CompanyController::class, 'get']);
        Route::put('/', [CompanyController::class, 'update']);
        //All inventory type routes
        Route::prefix('/inventorytype')->group(function () {
            Route::get('/', [CompanyController::class, 'getInventoryTypes']);
            Route::post('/', [CompanyController::class, 'addInventoryType']);
            Route::prefix('/{inventorytype}')->group(function () {
                Route::put('/', [CompanyController::class, 'updateInventoryType']);
                Route::delete('/', [CompanyController::class, 'deleteInventoryType']);
            });
        });
        //All department routes
        Route::prefix('/department')->group(function () {
            Route::get('/', [CompanyController::class, 'getDepartments']);
        });
        //All inventory routes
        Route::prefix('/inventory')->group(function () {
            Route::get('/', [CompanyController::class, 'getInventories']);
            Route::post('/', [CompanyController::class, 'addInventory']);
            Route::prefix('/{inventory}')->group(function () {
                Route::put('/', [CompanyController::class, 'updateInventory']);
                Route::delete('/', [CompanyController::class, 'deleteInventory']);
            });
        });
        //All expensetype routes
        Route::prefix('/expensetype')->group(function () {
            Route::get('/', [CompanyController::class, 'getExpenseTypes']);
            Route::post('/', [CompanyController::class, 'addExpenseType']);
            Route::prefix('/{expensetype}')->group(function () {
                Route::put('/', [CompanyController::class, 'updateExpenseType']);
                Route::delete('/', [CompanyController::class, 'deleteExpenseType']);
            });
        });
    });
});
