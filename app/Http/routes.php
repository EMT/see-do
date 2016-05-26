<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Shared across cities
|--------------------------------------------------------------------------
|
| Anything that doesn't need to be restricted to invidiual cities,
| such as Authentication and Registration.
|
| Icons and color schemes are also global to keep the design of the
| site consistent.
|
*/

// Color Scheme routes
Route::model('color-schemes', 'App\ColorScheme');
Route::resource('color-schemes', 'ColorSchemesController');

// Color Scheme routes
Route::model('icons', 'App\Icon');
Route::resource('icons', 'IconsController');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register/{token}', ['middleware' => 'token', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register/', ['uses' => 'Auth\AuthController@postRegister']);

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

/*
|--------------------------------------------------------------------------
| City routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'CitiesController@index');
Route::resource('cities', 'CitiesController');

Route::resource('{city}/categories', 'CategoriesController', [
    'parameters' => 'singular'
]);

// Subscriber routes
Route::get('/{city}/subscribers/hello', function () {
    return view('subscribers.hello');
});
Route::get('/{city}/subscribers/updated', function () {
    return view('subscribers.updated');
});
Route::get('/{city}/subscribers/unsubscribed', function () {
    return view('subscribers.unsubscribed');
});
Route::get('/{city}/subscribers/{subscriber}/edit', 'SubscribersController@edit');
Route::put('/{city}/subscribers/{subscriber}', 'SubscribersController@update');
Route::get('/{city}/subscribers/{subscriber}/unsubscribe', 'SubscribersController@destroy');
Route::resource('/{city}/subscribers', 'SubscribersController', [
    'parameters' => 'singular'
]);

// User Profile routes
Route::post('/{city}/users/create', array('uses' => 'UsersController@registerEmail'));
Route::resource('/{city}/users', 'UsersController', [
    'parameters' => 'singular'
]);

Route::get('/{city}', 'EventsController@index');
Route::get('/{city}/events', 'EventsController@index');
Route::get('/{city}/events/create', 'EventsController@create');
Route::get('/{city}/events/{event}.json', 'EventsController@showJson');

Route::resource('{city}/events', 'EventsController', [
    'parameters' => 'singular'
]);

