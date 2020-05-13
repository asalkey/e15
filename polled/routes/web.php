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

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'PollsController@index');
	Route::post('/poll', 'PollsController@store');
	Route::get('/poll/create', 'PollsController@create');
	Route::get('/poll/{id}/edit', 'PollsController@edit');
	Route::get('/poll/{id}', 'PollsController@show');
	Route::delete('/user/poll/delete', 'PollsController@destroy');

	Route::get('/result/{id}', 'ResultsController@show');
	Route::post('/result', 'ResultsController@store');
	
	Route::get('/user/polls', 'UserController@showPolls');
	Route::get('/user/profile', 'UserController@showProfile');
	Route::put('/user/profile/edit', 'UserController@updateProfile');
});

Auth::routes();
