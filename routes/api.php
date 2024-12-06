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

Route::GET('users','UserController@index');
//Route::GET('arsips','ArsipController@index');
Route::GET('/arsips', 'ArsipController@index');
Route::GET('/indexactivitylist', 'ArsipController@indexactivitylist');
Route::GET('/arsips/{arsip}', function ($arsip){

    $fileContents = Storage::disk('local')->get("public/arsip/{$arsip}");

    return Response::make($fileContents, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="'.$arsip.'"'
    ]);
});
Route::GROUP(['prefix' => 'v1'], function () {
    Route::POST('/add-activity', 'AktifitasController@store');
    Route::GET('/index-activity', 'AktifitasController@index');
    Route::POST('/login', 'UsersController@login');
    Route::POST('/register', 'UsersController@register');
    Route::GET('/logout', 'UsersController@logout')->middleware('auth:api');
});
//Route::group([
//    'prefix' => 'auth'
//], function () {
//    Route::post('login', 'Auth\AuthController@login')->name('login');
//    Route::get('register', 'Auth\AuthController@register');
//    Route::group([
//        'middleware' => 'auth:api'
//    ], function() {
//        Route::get('logout', 'Auth\AuthController@logout');
//        Route::get('user', 'Auth\AuthController@user');
//    });
//});

