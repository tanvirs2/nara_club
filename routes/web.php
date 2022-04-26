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

//score
Route::get('/', 'DashboardController@index')->name('home');
Route::post('score-store/', 'ScoreController@store')->name('score-store');
Route::put('score-update/{score}', 'ScoreController@update')->name('score-update');

//member
Route::post('member-store/', 'MemberController@store')->name('member-store');

//member library
Route::get('member-lib-list/', 'MemberLibController@index')->name('member-lib-list');
Route::post('member-lib-store/', 'MemberLibController@store')->name('member-lib-store');

//game
Route::post('game-store/', 'GameController@store')->name('game-store');
Route::get('game-delete/{game}', 'GameController@destroy')->name('game-delete');

//point
Route::post('point-store/', 'PointController@store')->name('point-store');
