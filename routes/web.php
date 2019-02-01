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
    return view('main');
});

Auth::routes();

Route::group( ['middleware' => 'auth'], function() {
      Route::resource('tournaments', 'TournamentController');
});

Route::get('/privacy', function () {
    return view('parts.privacy');
});

Route::get('/terms', function () {
    return view('parts.terms');
});
