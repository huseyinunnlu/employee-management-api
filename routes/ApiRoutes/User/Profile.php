<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AbsenceController;
use App\Http\Controllers\Profile\CertificateController;
use App\Http\Controllers\Profile\DebitController;
use App\Http\Controllers\Profile\DocumentController;
use App\Http\Controllers\Profile\EducationInfoController;
use App\Http\Controllers\Profile\ForeignLanguageController;
use App\Http\Controllers\Profile\ReferenceController;
use App\Http\Controllers\Profile\ReportController;
use App\Http\Controllers\Profile\WorkExperienceController;


//All profile routes
Route::prefix('profile')->group(function () {

    //Get profile details by slug
    Route::prefix('/{user:slug}')->group(function () {
        Route::get('/', [ProfileController::class, 'get']);
    });

    //Update all another informations of user
    Route::prefix('/{user}')->group(function () {
        //Update profile photo email etc.
        Route::put('/updatephoto', [ProfileController::class, 'updatePhoto']);
        Route::put('/updatepassword', [ProfileController::class, 'updatePassword']);
        Route::put('/updateemail', [ProfileController::class, 'updateEmail']);
        Route::put('/updatepersonalinfo', [ProfileController::class, 'updatePersonalInfo']);
        Route::prefix('/emergencycontact')->group(function () {
            Route::post('/', [ProfileController::class, 'addEmergencyContact']);
            Route::delete('/{emergenctcontact}', [ProfileController::class, 'deleteEmergencyContact'])->scopeBindings();
        });
        //All of these routes have get,store,update,and delete.
        Route::apiResource('/educationinfo', EducationInfoController::class);
        Route::apiResource('/certificate', CertificateController::class);
        Route::apiResource('/foreignlanguage', ForeignLanguageController::class);
        Route::apiResource('/workexperience', WorkExperienceController::class);
        Route::apiResource('/reference', ReferenceController::class);

        Route::apiResource('/debit', DebitController::class);
        Route::apiResource('/document', DocumentController::class);
        Route::apiResource('/absence', AbsenceController::class);
        Route::apiResource('/report', ReportController::class);
    });
});
