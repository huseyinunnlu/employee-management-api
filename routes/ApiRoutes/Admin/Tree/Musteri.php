<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Tree\MusteriController;
use App\Http\Controllers\Admin\Tree\TreeController;

//All musteri routes
Route::prefix('musteri/{musteri}')->group(function () {
    Route::get('/', [MusteriController::class, 'get']);
    Route::put('/', [MusteriController::class, 'update']);
    //All employeer branch routes
    Route::prefix('employeerbranch')->group(function () {
        Route::get('/', [MusteriController::class, 'getEmployeerBranches']);
        Route::post('/', [MusteriController::class, 'addEmployeerBranch']);
        Route::prefix('/{employeerbranch}')->group(function () {
            Route::put('/', [MusteriController::class, 'updateEmployeerBranch']);
            Route::delete('/', [MusteriController::class, 'deleteEmployeerBranch']);
        });
    });
    //All company routes
    Route::prefix('/company')->group(function () {
        Route::get('/', [MusteriController::class, 'getCompanies']);
        Route::prefix('/{company}')->group(function () {
            Route::delete('/', [MusteriController::class, 'deleteCompany']);
        });
    });
    //All employee routes
    Route::prefix('/employee')->group(function () {
        Route::get('/', [TreeController::class, 'getEmployeesByTree']);
    });
});
