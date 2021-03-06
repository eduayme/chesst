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

Route::resource('/', 'HomeController');

Route::get('lang/{lang}', function ($lang) {
    \Session::put('lang', $lang);

    return \Redirect::back();
})->middleware('web')->name('change_lang');

Auth::routes();

Route::get('/explore', 'TournamentController@explore');

Route::resource('tournaments', 'TournamentController');

Route::get('get-cities-list', 'TournamentController@getCitiesList');

Route::get('/mytournaments', 'MyTournaments@index');

Route::get('/privacy', function () {
    return view('parts.privacy');
});

Route::get('/terms', function () {
    return view('parts.terms');
});
