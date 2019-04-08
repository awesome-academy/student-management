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

Route::get('/', 'RouteController@returnWelcome');

Route::get('students/login', 'RouteController@returnLogin');

Route::get('students/register', 'RouteController@returnRegister');

Route::post('students/register', 'RegisterController@doStudentRegister');

Route::group(['prefix' => 'students'], function() {
	
});
