<?php

use Illuminate\Support\Facades\Auth;
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
//dd(app());
/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'TrainingController@index')->name('training_home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function()
{

Route::post('/training', 'TrainingController@store')->name('training_store');
//Route::get('/training/{training}', 'TrainingController@show')->name('training_show');

Route::get('/training_s3/{training}', 'TrainingController@show_s3')->name('training_show_s3');

Route::get('/training/{training}/edit', 'TrainingController@edit')->name('training_edit');

Route::patch('/training/{training}', 'TrainingController@update')->name('training_update');

Route::delete('/training/{training}', 'TrainingController@destroy')->name('training_destroy');
Route::get('/training/create', 'TrainingController@create')->name('training_create');

//Route::resource('training','TrainingController');
});
Route::get('/training/{training}', 'TrainingController@show')->name('training_show');

Route::get('/training_search', 'TrainingController@search')->name('training_search');