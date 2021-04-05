<?php

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
Auth::routes(['verify' => true]);

Route::middleware('verified')->group(function() {
// 本登録していないとアクセスできないURL
});
    

Route::get('/', 'App\Http\Controllers\PostsController@index')->name('top');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');



Route::resource('comments', 'App\Http\Controllers\CommentsController', ['only' => ['store']]);
Route::resource('posts', 'App\Http\Controllers\PostsController', ['only' => ['create', 'store','show','edit','update','destroy']]);

Route::get('posts/{post}/favorites', 'App\Http\Controllers\FavoriteController@store');
Route::get('posts/{post}/unfavorites', 'App\Http\Controllers\FavoriteController@destroy');
Route::get('posts/{post}/countfavorites', 'App\Http\Controllers\FavoriteController@count');
Route::get('posts/{post}/hasfavorites', 'App\Http\Controllers\FavoriteController@hasfavorite');
//参考https://idealive.jp/blog/2019/04/02/laravelでメール認証をやる/
Route::get('/user/userEdit', 'App\Http\Controllers\UserController@userEdit')->name('user.userEdit');
Route::post('/user/userEdit', 'App\Http\Controllers\UserController@userUpdate')->name('user.userUpdate');

Route::resource('users', 'App\Http\Controllers\UserController', ['only' => ['store','show','edit','update']]);




// 画像保存用
Route::post('/posts/temp', 'App\Http\Controllers\PostsController@image')->name('summernote.image');