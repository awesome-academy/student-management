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
    Route::group(['prefix' => 'information'], function() {
        Route::get('/', 'RouteController@returnStudentInformation')->name('students.return_information');
        Route::get('/update', 'RouteController@returnStudentUpdateInformation')
        ->name('students.return_update_information');
        Route::post('/update', 'HomeController@updateStudentInformation')->name('student.do_update_information');
    });
    Route::group(['prefix' => 'subject-registration'], function() {
        Route::get('/', 'RouteController@returnSubjectRegistration')->name('students.return_subject_registration');
        Route::post('/', 'SubjectRegisterController@registerSubject')->name('students.do_subject_registration');
        Route::post('/class-table-ajax', 'AjaxController@getClassTable')->name('students.class_table_ajax');
        Route::get('/cancel-registration/{id}', 'CancelRegistrationController@cancelRegistration')
        ->name('students.cancel_registration');
        Route::get('/registration-instruction', 'RouteController@returnRegistrationInstruction')
        ->name('students.registration-instruction');
    });
    Route::get('/schedule', 'RouteController@returnSchedule')->name('students.return_schedule');
    Route::post('schedule/schedule-table-ajax', 'AjaxController@getSchedule')->name('students.schedule_table_ajax');
    Route::get('/point', 'RouteController@returnPoint')->name('students.return_point');
});

Route::get('admins/login', 'RouteController@returnAdminLogin')->name('admins.return_login');

Route::post('admins/login', 'AdminLoginController@doAdminLogin')->name('admins.do_login');

Route::group(['prefix' => 'admins', 'middleware' => 'admin-check'], function()
{
    Route::get('/home', 'RouteController@returnAdminHome')->name('admins.return_home');
    Route::get('/logout', 'RouteController@adminLogout')->name('admins.do_logout');
    Route::group(['prefix' => 'profile'], function() {
        Route::get('/', 'RouteController@returnAdminProfile')->name('admins.return_profile');
        
    });
    Route::group(['prefix' => 'generation-management'], function()
    {
        Route::get('/', 'RouteController@returnGenerationManagement')
            ->name('admins.return_generation_management');
        Route::get('/generation-table-ajax', 'AjaxController@getGenerationTable')->name('admins.generation-table-ajax');
        Route::get('/generation-modal-ajax', 'AjaxController@getGenerationModal')
            ->name('admins.generation-modal-ajax');
        Route::get('/add-generation', 'GenerationManagementController@addGeneration')
            ->name('admins.add-generation');
        Route::get('/update-generation/{id}', 'GenerationManagementController@updateGeneration')
            ->name('admins.update-generation');
        Route::get('/delete-generation/{id}', 'GenerationManagementController@deleteGeneration')
            ->name('admins.delete-generation');
    });
    
});
