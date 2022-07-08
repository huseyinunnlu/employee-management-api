<?php

use App\Http\Controllers\Admin\Tree\TreeController;
use Illuminate\Support\Facades\Route;

//Gets users for manager adding by role for company and department
Route::get('getuserforaddmanager', [TreeController::class, 'getUsersForManagerAdding']);

//Get managers of company or department
Route::get('{id}', [TreeController::class, 'getManagers']);
//Give manager permission for company or deparment
Route::post('storeuserperms', [TreeController::class, 'storeUserPerms']);
//Delete company, department and work place
Route::delete('{id}', [TreeController::class, 'deleteTree']);
//Delete managers of company, department or work place
Route::delete('manager/{userperm:user_id}', [TreeController::class, 'deleteManager']);
