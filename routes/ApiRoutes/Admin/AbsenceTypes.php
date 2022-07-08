<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Settings\AbsenceTypeController;

//All routes of work place
Route::prefix('absencetype')->group(function () {
    Route::get('/', [AbsenceTypeController::class, 'get']);
    Route::post('/', [AbsenceTypeController::class, 'store']);
    Route::prefix('/{absencetype}')->group(function () {
        Route::put('/', [AbsenceTypeController::class, 'update']);
        Route::delete('/', [AbsenceTypeController::class, 'destroy']);
        Route::prefix('title/{absencetypetitle}')->group(function () {
            Route::put('/', [AbsenceTypeController::class, 'updateAbsenceTypeTitle']);
            Route::delete('/', [AbsenceTypeController::class, 'destroyAbsenceTypeTitle']);
        });
    });
});
