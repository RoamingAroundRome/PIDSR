<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::middleware('auth:api')->group(function () {
        Route::post('password/change', 'AuthController@changePassword');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('user', 'AuthController@user');
    });
});

Route::middleware('auth:api')->group(function () {
    Route::apiResources([
        'users' => 'UserController',
        'diseases' => 'DiseaseController',
        'drus' => 'DRUController',
        'reports' => 'ReportController'
    ]);

    // Users avatar
    Route::post('users/upload-avatar/{user}', 'AvatarController@upload');
    Route::get('users/remove-avatar/{user}', 'AvatarController@remove');

    // Reports
    Route::get('reports/cases/all-latest-entries', 'ReportController@allLatestEntries');
    Route::get('reports/cases/latest-entries', 'ReportController@latestEntries');
    Route::get('reports/cases/summary', 'ReportController@cases');
    Route::post('reports/search', 'ReportController@search');
});


