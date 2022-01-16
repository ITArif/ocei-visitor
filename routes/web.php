<?php

use App\Http\Controllers\Backend\OfficialController;
use App\Http\Controllers\Backend\AppointmentController;
use App\Http\Controllers\Backend\ReceptionistController;
use Illuminate\Support\Facades\Route;


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
// Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });
////*************all visitor************
//Route::get('/all-visitor','Backend\VisitorController@allVisitor')->name('all-visitor');
//Visitor Delete & Forword
//Route::post('/delete/all/visitors','Backend\VisitorController@deleteAll');
//Route::post('/activate/all/visitors','Backend\VisitorController@forwordAll');
///*********employee***************//
//Route::get('/all-forward-visitor','Backend\EmployeeController@forwardingVisitor')->name('forward-visitor');

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});


Route::get('/', 'Auth\VisitorLoginController@showLoginForm')->name('visitor.login');
Route::post('/visitor_login_check', 'Auth\VisitorLoginController@visitor_login_check')->name('visitor.login_check');
Route::post('/visitor_logout', 'Auth\VisitorLoginController@logout')->name('visitor.logout');

Route::middleware('visitor')->group(function(){
	Route::get('/dashboard', 'Backend\HomeController@dashboard')->name('dashboard');
    ////*************Appoinment*********************////
    Route::match(['get','post'],'official/list','Backend\OfficialController@officiallist')->name('official.list');

    Route::group(['prefix' => 'appointment'], function () {
        Route::get('/create/{employee_id}',[OfficialController::class, 'createAppointment'])->name('showAppointmentForm');
        Route::post('/store',[OfficialController::class, 'storeAppointment'])->name('storeAppointment');
        /////**********Appontment List And searching******************/////
        Route::match(['get','post'],'/list',[AppointmentController::class, 'appointmentlist'])->name('appointment.list');
     });
});

Route::middleware('receptionist')->group(function(){
    Route::get('/receptionists-dashboard', 'Backend\HomeController@receptionistDashboard')->name('receptionist.dashboard');
    Route::get('/appointment/history', [ReceptionistController::class, 'appontmentHistoryData'])->name('appontmentHistoryData');
    Route::get('/archive/appointment', [ReceptionistController::class, 'archiveAppointmentData'])->name('archiveAppointmentData');
    Route::group(['prefix' => 'receptionists'], function () {
      Route::match(['get','post'],'/appointment/list', [ReceptionistController::class,'checkAppointmentList'])->name('checkAppointmentList');
      Route::get('/create/appointment/{appointment_id}',[ReceptionistController::class, 'receptionistsCreateAppointment'])->name('showreReptionistsAppointment');
      Route::post('/store',[ReceptionistController::class, 'storeReceptionistsData'])->name('storeReceptionistsData');
      Route::post('/appointment/done', [ReceptionistController::class, 'doneAppointment']);
      Route::post('/appointment/pending',[ReceptionistController::class, 'pendingAppointment']);
      //////********In receptionist Ongoing appointment done**********///
      //Route::get('/done/ongoing-appointment/{id}', [ReceptionistController::class, 'doneOngoingAppointment']);
    });
});


/////**********************frontend**********************************
Route::get('/home','Frontend\HomeController@index')->name('home');
///*********************registration*******************
Route::get('/registration','Frontend\RegistrationController@register')->name('register');
Route::post('/register','Frontend\RegistrationController@storeRegister')->name('store.register');
Route::match(['get','post'],'/confirmEmail/{code}','Frontend\RegistrationController@confirmAccount')->name('confirm.account');

///**********Visitor forgot password**********************************//
Route::get('/forgot/password/','Auth\VisitorReceptionistForgetPasswordController@forgotPassword')->name('forgotPassword');
//sendResetLinkEmail ai method ta ase trait a ForgotPasswordController er mordhee
Route::post('/send/reset/link','Auth\VisitorReceptionistForgetPasswordController@sendResetLinkEmail')
    ->name('send.reset.link');
Route::get('/password/reset/{token}','Auth\VisitorReceptionistResetPasswordController@showResetForm')
->name('password.reset');
//override korbo na ata trait er mordhee ase----reset method a kintu post method ase Request
Route::post('/password/reset','Auth\VisitorReceptionistResetPasswordController@reset')
->name('password.request');


