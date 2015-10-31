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

// Provide controller methods with object instead of ID
Route::model('events', 'Event');
Route::model('categories', 'Category');
Route::model('color-schemes', 'App\ColorScheme');

// Use slugs rather than IDs in URLs
Route::bind('categories', function ($value, $route) {
    return App\Category::whereSlug($value)->first();
});
Route::bind('events', function ($value, $route) {
    return App\Event::whereSlug($value)->first();
});

// Route::get('/', function() {
// 	return view('welcome');
// });

Route::get('/', 'EventsController@index');

Route::resource('categories', 'CategoriesController');
Route::get('events/{value}.json', 'EventsController@showJson');
Route::resource('events', 'EventsController');
Route::resource('color-schemes', 'ColorSchemesController');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::controllers([
   'password' => 'Auth\PasswordController',
]);
