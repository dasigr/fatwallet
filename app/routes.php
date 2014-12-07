<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(
    array(
        'before' => 'auth.basic',
        'prefix' => 'v1'
    ), function()
    {
        Route::resource('users', 'UserController');
        Route::resource('categories', 'CategoryController');
        Route::resource('merchants', 'MerchantController');
        Route::resource('expenses', 'ExpenseController');
    }
);

Route::get('/', function()
{
	return View::make('hello');
});
