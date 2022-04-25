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
Route::middleware(['auth'])->group(function () {
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::resource('/presence', '\App\Http\Controllers\Dashboard\PageUserController');
    Route::post('/store', '\App\Http\Controllers\Dashboard\PageUserController@store')->name('presence.store');
    Route::post('/save', '\App\Http\Controllers\Dashboard\PageUserController@save')->name('presence.save');
    Route::get('/calender', '\App\Http\Controllers\Dashboard\PageUserController@calender')->name('calender');
    Route::get('/events', '\App\Http\Controllers\EventController@index')->name('events');
    Route::post('fullcalenderAjax', '\App\Http\Controllers\EventController@ajax');

    Route::get('/profile/{id}/edit', '\App\Http\Controllers\Dashboard\ProfileController@profile')->name('presence.profile');
    Route::put('/updateprofile/{id}', '\App\Http\Controllers\Dashboard\ProfileController@updateprofile')->name('updateprofile');
    Route::put('/image/{id}', '\App\Http\Controllers\Dashboard\ProfileController@updateimage')->name('updateimage');
    Route::get('/calc', '\App\Http\Controllers\Dashboard\ProfileController@calc')->name('calc');
    Route::Delete('/deleteimage/{id}', '\App\Http\Controllers\Dashboard\ProfileController@destroy')->name('deleteimage');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
