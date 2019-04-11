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

Route::get('students/login', 'RouteController@returnStudentLogin')->name('students.return_login');

Route::post('students/login', 'LoginController@doStudentLogin')->name('students.do_login');

Route::get('students/register', 'RouteController@returnStudentRegister')->name('students.return_register');

Route::get('students/logout', 'RouteController@studentLogout')->name('students.do_logout');

Route::post('students/register', 'RegisterController@doStudentRegister')->name('students.do_register');

Route::group(['prefix' => 'students', 'middleware' => 'check'], function()
{
	Route::get('/home', 'RouteController@returnStudentHome')->name('students.return_home');
});
