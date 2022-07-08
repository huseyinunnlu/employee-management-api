<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Reports\AbsenceReportController;
use App\Http\Controllers\Admin\Reports\DebitReportController;
use App\Http\Controllers\Admin\Reports\DocumentReportController;
use App\Http\Controllers\Admin\Reports\StatisticController;

//All report routes
Route::prefix('reports/')->group(function () {
    //All general statistic routes
    Route::prefix('generalstatistics/')->group(function () {
        Route::get('/', [StatisticController::class, 'get']);
    });
    //All absence reports routes
    Route::prefix('absencereports')->group(function () {
        Route::get('/getusers', [AbsenceReportController::class, 'getAddUsers']);
        Route::post('/', [AbsenceReportController::class, 'addAbsence']);
        Route::get('/', [AbsenceReportController::class, 'get']);
    });
    //All document reports routes
    Route::prefix('documentreports')->group(function () {
        Route::get('/', [DocumentReportController::class, 'get']);
    });
    //All debit reports routes
    Route::prefix('debitreports')->group(function () {
        Route::get('/', [DebitReportController::class, 'get']);
    });
});
