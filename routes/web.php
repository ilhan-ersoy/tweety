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
    return view('welcome');
});

Route::middleware('auth')->group(function (){

    Route::get('/profiles/{user}/edit','ProfilesController@edit')->name('edit');

    Route::get('/tweets','TweetsController@index')->name('home');

    Route::post('/tweets','TweetsController@store')->name('setTweet');

    Route::post('/tweet/delete/{id}','TweetsController@deleteTweet')->name('deleteTweet');




    Route::post('/profiles/{user}/follow','followsController@store')->name('follow');

    Route::patch('/profiles/{user}','ProfilesController@update')->name('profile');

    Route::get('/explore','ExploreController');

});


Route::get('/profiles/{user}','ProfilesController@show')->name('profile');


Auth::routes();


