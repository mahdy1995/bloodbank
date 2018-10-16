<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1'], function(){

    Route::post('register', 'ClientController@register');
    Route::post('login', 'ClientController@login');

    Route::group(['middleware' => 'auth:api'], function (){
        Route::apiResource('articles', 'ArticleController');
        Route::apiResource('requests', 'BloodRequestController');
        Route::apiResource('categories', 'CategoryController');
        Route::apiResource('cities', 'CityController');
        Route::apiResource('clients', 'ClientController');
        Route::apiResource('contact', 'ContactController');
        Route::apiResource('governorates', 'GovernoratesController');
        Route::apiResource('notifications', 'NotficationController');
        Route::apiResource('reports', 'ReportController');
        Route::apiResource('settings', 'SettingController');
    });
});
