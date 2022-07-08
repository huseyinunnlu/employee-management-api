<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\MyExpenseController;

/*
|--------------------------------------------------------------------------
| Expense Routes
|--------------------------------------------------------------------------
*/

//All my expenses routes

Route::prefix('myexpense')->group(function () {
    Route::get('/', [MyExpenseController::class, 'get']);
    Route::post('/', [ExpenseController::class, 'store']);
    Route::prefix('/{expense}')->group(function () {
        Route::put('/', [ExpenseController::class, 'update']);
        Route::delete('/', [ExpenseController::class, 'delete']);
        Route::scopeBindings()->prefix('/expenseline')->group(function () {
            Route::post('/', [ExpenseController::class, 'addExpenseLine']);
            Route::scopeBindings()->prefix('/{expenseline}')->group(function () {
                Route::delete('/', [ExpenseController::class, 'deleteExpenseLine']);
                Route::put('/', [ExpenseController::class, 'updateExpenseLine']);
            });
        });
    });
});
