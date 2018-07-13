<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user/login', 'ApiLoginController@login')->name('api.user.login');

Route::post('/user/register', 'ApiRegisterController@register')->name('api.user.register');

Route::middleware('jwt.auth')->group(function() {

	Route::get('/users', function(Request $request) {
		return Auth::user();
	});

});

Route::middleware('auth:api')->group(function () {
    //Route::post('/post/{post}/comment', 'CommentController@store');
});
