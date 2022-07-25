<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['is_auth', 'admin']], function () {
    Route::resource('/admin', '\App\Http\Controllers\Dashboard\AdminPageController');
});


Route::middleware(['is_auth'])->group(function () {
    Route::resource('/presence', '\App\Http\Controllers\Dashboard\AttendanceController');
    Route::group(['middleware' => ['active']], function () {
        Route::get('changeStatus', '\App\Http\Controllers\Dashboard\AdminPageController@changeStatus');
        Route::get('getAttendance/{id}', '\App\Http\Controllers\Dashboard\AdminPageController@getAttendance')->name('getAttendance');
        Route::get('getcalender', '\App\Http\Controllers\Dashboard\AdminPageController@getCalender')->name('getcalender');
        Route::post('store', '\App\Http\Controllers\Dashboard\AttendanceController@store');
        Route::get('/calender', '\App\Http\Controllers\Dashboard\AttendanceController@calender')->name('calender');
        Route::get('/profile/{id}/edit', '\App\Http\Controllers\Dashboard\ProfileController@profile')->name('presence.profile');
        Route::put('/updateprofile/{id}', '\App\Http\Controllers\Dashboard\ProfileController@updateprofile')->name('updateprofile');
        Route::get('/updatesalary/{id}', '\App\Http\Controllers\Dashboard\AdminPageController@updateSalary')->name('updateSalary');
        Route::put('/image/{id}', '\App\Http\Controllers\Dashboard\ProfileController@updateimage')->name('updateimage');
        Route::get('/calc', '\App\Http\Controllers\Dashboard\ProfileController@calc')->name('calc');
        Route::Delete('/deleteimage/{id}', '\App\Http\Controllers\Dashboard\ProfileController@destroy')->name('deleteimage');
    });

});
Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login')->middleware('AlreadyLogedIn');
Route::get('/register', [App\Http\Controllers\LoginController::class, 'register'])->name('register')->middleware('AlreadyLogedIn');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('forget-password', [\App\Http\Controllers\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::get('reset-password/{token}', [\App\Http\Controllers\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/checkLogin', [App\Http\Controllers\LoginController::class, 'checkLogin'])->name('checkLogin');
Route::post('/checkRegister', [App\Http\Controllers\LoginController::class, 'checkRegister'])->name('checkRegister');
Route::post('forget-password', [\App\Http\Controllers\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::post('reset-password', [\App\Http\Controllers\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('store_user',[\App\Http\Controllers\PayOrderController::class,'store']);
