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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
// Route::get('/login',['middleware' => 'auth','uses' =>  'Auth\LoginController@login']);
// Route::post('/login',['middleware' => 'auth','uses' =>  'Auth\LoginController@login']);

Route::post('/top', 'Auth\LoginController@login');

Route::post('/login', 'Auth\LoginController@login');
Route::get('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::group(['middleware' => ['auth']], function () {
Route::get('/top','PostsController@index');
Route::post('post/create','PostsController@create');
Route::post('post/update{id}', 'PostsController@update');
Route::get('post/{id}/delete', 'PostsController@delete');
});
Route::get('/userprofile/{id}','PostsController@userprofile');

Route::get('/profile','UsersController@profile');
Route::post('/profileup','UsersController@profileupdate')->name('profileup');

Route::post('/searchs','UsersController@search');
Route::get('/search','UsersController@index')->name('search');

Route::POST('users/follow', 'UsersController@follow')->name('follow');
Route::POST('users/unfollow', 'UsersController@unfollow')->name('unfollow');


Route::group(['middleware' => 'auth'], function() {
Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');
});
Route::get('/follower-list','FollowsController@followerList');
