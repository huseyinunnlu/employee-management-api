<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\Tree\TreeController;

// /*
// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register API routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | is assigned the "api" middleware group. Enjoy building your API!
// |
// */

// //Login route
Route::post('login', [AuthController::class, 'login']);

//All auth routes
Route::middleware(['auth:api'])->group(function () {

    //Get authenticated user
    Route::get('user', [AuthController::class, 'getUser']);

    //Logout route
    Route::get('logout', [AuthController::class, 'logout']);

    //All profile routes
    require_once "ApiRoutes/User/Profile.php";

    //User expense routes
    require_once "ApiRoutes/User/Expense.php";

    Route::middleware(['isAdmin'])->prefix('admin/')->group(function () {

        //Employee routes
        require_once "ApiRoutes/Admin/Employees.php";

        Route::prefix('settings/')->group(function () {

            //Settings Document Types
            require_once "ApiRoutes/Admin/DocumentTypes.php";

            //Absence types
            require_once "ApiRoutes/Admin/AbsenceTypes.php";
        });

        //Company tree
        Route::get('companytree', [TreeController::class, 'getCompanyTree']);
        Route::prefix('tree/')->group(function () {
            //Tree
            require_once "ApiRoutes/Admin/Tree/Tree.php";

            //musteri
            require_once "ApiRoutes/Admin/Tree/Musteri.php";

            //Company
            require_once "ApiRoutes/Admin/Tree/Company.php";

            //Department
            require_once "ApiRoutes/Admin/Tree/Department.php";

            //Work place
            require_once "ApiRoutes/Admin/Tree/WorkPlace.php";
        });

        //Reports
        require_once "ApiRoutes/Admin/Reports.php";

        //Expense
        require_once "ApiRoutes/Admin/Expense.php";
    });
});

//Datas
require_once "ApiRoutes/User/Data.php";
