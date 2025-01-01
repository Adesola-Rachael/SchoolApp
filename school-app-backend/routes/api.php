<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffApplicationController;
use App\Http\Controllers\EnrolStudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('login', 'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('me', 'AuthController@me');

// });

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function(){
    Route::post('register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');



    Route::post('create_staff', [App\Http\Controllers\StaffApplicationController::class, 'create']);

    Route::get('view_staff', [App\Http\Controllers\StaffApplicationController::class, 'index']);
    Route::get('view_student', [App\Http\Controllers\EnrolStudentController::class, 'index']);

    Route::post('enrol_student', [App\Http\Controllers\EnrolStudentController::class, 'create']);


});