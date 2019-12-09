<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Route::get('/posts/{post}/comments', 'API\CommentController@index')->name('comments.index');

Route::middleware('auth:api')->group(function() {
    Route::post('/posts/{post}/comments', 'API\CommentController@store')->name('comments.store');
});
