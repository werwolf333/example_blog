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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', function () {
    return redirect('/messages');
});

Route::get('/messages', 'MessageController@index');
Route::get('/messages/create', 'MessageController@create'); 
Route::post('/messages', 'MessageController@store');
Route::delete('/messages/{messageId}', 'MessageController@delete');
Route::get('/messages/{messageId}/edit', 'MessageController@edit');
Route::patch('/messages/{messageId}', 'MessageController@update');

Route::get('/messages/{messageId}', 'MessageController@show');
Route::get('/messages/{messageId}/comments/create', 'CommentController@create'); 
Route::post('/messages/{messageId}/comments', 'CommentController@store');
Route::delete('/messages/{messageId}/comments/{commentId}', 'CommentController@delete');
Route::get('/messages/{messageId}/comments/{commentId}/edit', 'CommentController@edit');
Route::patch('/messages/{messageId}/comments/{commentId}', 'CommentController@update');

Route::get('/users', 'UserController@index');
Route::delete('/users/{userId}', 'UserController@delete');
Route::get('/users/{userId}/edit', 'UserController@edit');
Route::patch('/users/{userId}', 'UserController@update');
