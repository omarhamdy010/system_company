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
Route::resource('/presence','\App\Http\Controllers\Dashboard\PageUserController');
Route::post('/store','\App\Http\Controllers\Dashboard\PageUserController@store')->name('presence.store');
Route::post('/save','\App\Http\Controllers\Dashboard\PageUserController@save')->name('presence.save');
Route::put('/updateprofile/{id}','\App\Http\Controllers\Dashboard\PageUserController@updateprofile')->name('updateprofile');
Route::get('/profile/{id}/edit','\App\Http\Controllers\Dashboard\PageUserController@profile')->name('presence.profile');
Route::put('/image/{id}','\App\Http\Controllers\Dashboard\PageUserController@updateimage')->name('updateimage');
Route::Delete('/deleteimage/{id}','\App\Http\Controllers\Dashboard\PageUserController@destroy')->name('deleteimage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
