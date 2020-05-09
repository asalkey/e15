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

Route::get('/polls', 'PollsController@index');
Route::post('/polls', 'PollsController@create');
Route::get('/polls/new', 'PollsController@new');
Route::get('/polls/{id}/edit', 'PollsController@edit');
Route::get('/polls/{id}', 'PollsController@show');
Route::put('/polls', 'PollsController@update');
Route::delete('/polls/{id}', 'PollsController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
