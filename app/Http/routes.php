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


// Category routes
// Provide controller methods with object instead of ID
Route::model('{city}/categories', 'Category');
// Use slugs rather than IDs in URLs
Route::bind('{city}/categories', function ($value, $route) {
    return App\Category::whereSlug($value)->first();
});
Route::resource('{city}/categories', 'CategoriesController');


// Color Scheme routes
Route::model('color-schemes', 'App\ColorScheme');
Route::resource('color-schemes', 'ColorSchemesController');



// Color Scheme routes
Route::model('icons', 'App\Icon');
Route::resource('icons', 'IconsController');

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
Route::get('/{city}/subscribers/{token}/edit', 'SubscribersController@edit');
Route::put('/{city}/subscribers/{token}', 'SubscribersController@update');
Route::get('/{city}/subscribers/{token}/unsubscribe', 'SubscribersController@destroy');
Route::resource('/{city}/subscribers', 'SubscribersController');

// Mailer routes
// Route::model('mailers', 'App\Mailer');
// Route::post('mailers/generate', 'MailersController@generate');
// Route::get('mailers/now', 'MailersController@now');
// Route::resource('mailers', 'MailersController');

Route::get('/', 'CitiesController@index');
Route::resource('cities', 'CitiesController');

// User Profile routes
Route::post('{city}/users/create', array('uses' => 'UsersController@registerEmail'));
Route::resource('{city}/users', 'UsersController');

Route::get('/{city}', 'EventsController@index');
Route::get('/{city}/events', 'EventsController@index');
Route::get('/{city}/events/create', 'EventsController@create');
Route::get('/{city}/events/{slug}.json', 'EventsController@showJson');
Route::get('/{city}/events/{slug}', 'EventsController@show');


Route::resource('{city}/events', 'EventsController');

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

