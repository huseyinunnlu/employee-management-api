<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiDataController;

//All datas for dynamic select or filters
Route::get('/getlanguages', [ApiDataController::class, 'getLanguages']);
Route::get('/getcountries', [ApiDataController::class, 'getCountries']);
Route::get('/getcities', [ApiDataController::class, 'getCities']);
Route::get('/getnations', [ApiDataController::class, 'getNations']);
Route::get('/getroles', [ApiDataController::class, 'getRoles']);
Route::get('/getmusteris', [ApiDataController::class, 'getMusteris']);
Route::get('/getjobs', [ApiDataController::class, 'getJobs']);
Route::get('/getcompanies', [ApiDataController::class, 'getCompanies']);
Route::get('/getemployeerbranches', [ApiDataController::class, 'getEmployeerBranches']);
Route::get('/getdepartments', [ApiDataController::class, 'getDepartments']);
Route::get('/getpositions', [ApiDataController::class, 'getPositions']);
Route::get('/getmanagers', [ApiDataController::class, 'getManagers']);
Route::get('/getworkplaces', [ApiDataController::class, 'getWorkPlaces']);
Route::get('/getusers', [ApiDataController::class, 'getUsers']);
Route::get('/getpermsbyrole', [ApiDataController::class, 'getPermsByRole']);
Route::get('/getinventorytypes', [ApiDataController::class, 'getInventoryTypes']);
Route::get('/getinventoriesbytype', [ApiDataController::class, 'getInventoriesByType']);
Route::get('/getdocumenttypes', [ApiDataController::class, 'getDocumentTypes']);
Route::get('/getabsencetypes', [ApiDataController::class, 'getAbsenceTypes']);
Route::get('/getexpensetypes', [ApiDataController::class, 'getExpenseTypes']);
