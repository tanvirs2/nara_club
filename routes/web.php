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

Route::get('/', 'DashboardController@index')->name('home');
Route::post('score-store/', 'ScoreController@store')->name('score-store');
Route::put('score-update/{score}', 'ScoreController@update')->name('score-update');
