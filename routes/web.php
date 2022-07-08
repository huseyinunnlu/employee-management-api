<?php

use App\Http\Controllers\Admin\Reports\DocumentReportController;
use App\Models\Absence;
use App\Models\Company;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    Artisan::call('migrate:refresh');
    Artisan::call('migrate');
    Artisan::call('db:seed');
    Artisan::call('passport:install');
});


// Route::get('/test', function () {
//     $curl = curl_init();
//     curl_setopt($curl, CURLOPT_URL, 'https://parseapi.back4app.com/classes/City/1,2,5?keys=name,country,cityId');
//     curl_setopt($curl, CURLOPT_HTTPHEADER, array(
//         'X-Parse-Application-Id: mxsebv4KoWIGkRntXwyzg6c6DhKWQuit8Ry9sHja', // This is the fake app's application id
//         'X-Parse-Master-Key: TpO0j3lG2PmEVMXlKYQACoOXKQrL3lwM0HwR9dbH' // This is the fake app's readonly master key
//     ));
//     $data = json_decode(curl_exec($curl)); // Here you have the data that you need
//     print_r(json_encode($data, JSON_PRETTY_PRINT));
//     curl_close($curl);
// });
