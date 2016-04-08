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



// Route home page to events.index
Route::get('/', 'EventsController@index');

// Category routes
// Provide controller methods with object instead of ID
Route::model('categories', 'Category');
// Use slugs rather than IDs in URLs
Route::bind('categories', function ($value, $route) {
    return App\Category::whereSlug($value)->first();
});
Route::resource('categories', 'CategoriesController');

// Event routes
Route::model('events', 'Event');
Route::bind('events', function ($value, $route) {
    return App\Event::whereSlug($value)->first();
});
Route::get('events/{value}.json', 'EventsController@showJson');
Route::resource('events', 'EventsController');

// Color Scheme routes
Route::model('color-schemes', 'App\ColorScheme');
Route::resource('color-schemes', 'ColorSchemesController');

// User Profile routes
Route::post('users/create', array('uses' => 'UsersController@registerEmail'));
Route::resource('users', 'UsersController');

// Color Scheme routes
Route::model('icons', 'App\Icon');
Route::resource('icons', 'IconsController');

// Subscriber routes
Route::get('subscribers/hello', function () {
    return view('subscribers.hello');
});
Route::get('subscribers/updated', function () {
    return view('subscribers.updated');
});
Route::get('subscribers/unsubscribed', function () {
    return view('subscribers.unsubscribed');
});
Route::get('subscribers/{token}/edit', 'SubscribersController@edit');
Route::put('subscribers/{token}', 'SubscribersController@update');
Route::get('subscribers/{token}/unsubscribe', 'SubscribersController@destroy');
Route::resource('subscribers', 'SubscribersController');

// Mailer routes
// Route::model('mailers', 'App\Mailer');
// Route::post('mailers/generate', 'MailersController@generate');
// Route::get('mailers/now', 'MailersController@now');
// Route::resource('mailers', 'MailersController');

Route::get('admin',  ['middleware' => ['role:admin'], function() {
	return view('admin.index');
}]);

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

