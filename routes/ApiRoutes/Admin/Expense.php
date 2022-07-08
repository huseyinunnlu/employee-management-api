<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ExpenseController;

//All expense routes
Route::prefix('expense')->group(function () {
    Route::get('/', [ExpenseController::class, 'get']);
    Route::post('/', [ExpenseController::class, 'store']);
    Route::prefix('/{expense}')->group(function () {
        Route::put('/', [ExpenseController::class, 'update']);
        Route::delete('/', [ExpenseController::class, 'delete']);
        Route::prefix('/expenseline')->group(function () {
            Route::post('/', [ExpenseController::class, 'addExpenseLine']);
            Route::prefix('/{expenseline}')->group(function () {
                Route::put('/', [ExpenseController::class, 'updateExpenseLine']);
                Route::delete('/', [ExpenseController::class, 'deleteExpenseLine']);
            });
        });
    });
});
