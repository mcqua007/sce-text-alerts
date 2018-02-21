<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['uses' => 'MainController@index', 'as' => 'index']);

Route::any('/enrollment', ['uses' => 'MainController@enrollment', 'as' => 'enrollment']);

Route::any('/verification', ['uses' => 'MainController@verification', 'as' => 'verification']);

Route::any('/confirmation', ['uses' => 'MainController@confirmation', 'as' => 'confirmation']);


Route::any('/start-over', ['uses' => 'MainController@start_over', 'as' => 'start-over']);

