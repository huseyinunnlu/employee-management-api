<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Tree\WorkPlaceController;

//All routes of work place
Route::prefix('workplace')->group(function () {
    Route::post('/', [WorkPlaceController::class, 'add']);

    Route::prefix('/{workplace}')->group(function () {
        Route::get('/', [WorkPlaceController::class, 'get']);
        Route::put('/updateworkinghour', [WorkPlaceController::class, 'updateWorkingHour']);
        Route::put('/', [WorkPlaceController::class, 'update']);
    });
});
