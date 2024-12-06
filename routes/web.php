<?php

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
    return view('welcome');
});

// Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

 // Password Reset Routes...
//  Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//  Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//  Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//  Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::group(['middleware' => 'auth'], function () {

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

// User
Route::get('/users', 'Admin\UserController@index');
Route::post('/user', 'Admin\UserController@store');
Route::get('/user/edit/{user}', 'Admin\UserController@edit');
Route::put('/user/{user}', 'Admin\UserController@update');
Route::delete('/user/{user}', 'Admin\UserController@destroy');

// Category
Route::get('/categories', 'Admin\CategoryController@index');
Route::post('/category', 'Admin\CategoryController@store');
Route::get('/category/edit/{category}', 'Admin\CategoryController@edit');
Route::put('/category/{category}', 'Admin\CategoryController@update');
Route::delete('/category/{category}', 'Admin\CategoryController@destroy');

//Arsip
Route::get('/surat-masuk', 'Admin\ArsipController@masuk');
Route::get('/surat-keluar', 'Admin\ArsipController@keluar');
Route::delete('/arsip/{arsip}', 'Admin\ArsipController@destroy');
Route::get('/arsip', 'Admin\ArsipController@arsip');
Route::get('/add-arsip', 'Admin\ArsipController@index');
Route::post('/add-arsip', 'Admin\ArsipController@store');
Route::get('/arsip/edit/{id}', 'Admin\ArsipController@edit');
Route::get('/arsip/detail/{id}', 'Admin\ArsipController@detail');
Route::get('/arsip/{status}/{arsip}', 'Admin\ArsipController@acc');
Route::put('/arsip/{arsip}', 'Admin\ArsipController@update');

//Activity
Route::get('/add-activity', 'Admin\ActivityController@index');
Route::post('/add-activity', 'Admin\ActivityController@store');
});
