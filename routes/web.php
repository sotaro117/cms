<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{post}', 'PostController@show')->name('post');

Route::middleware('auth')->group(function(){
  Route::get('/admin', 'AdminController@index')->name('admin.index');

  Route::get('/admin/posts', 'PostController@index')->name('post.index');
  Route::get('/admin/posts/create', 'PostController@create')->name('post.create');
  Route::post('/admin/posts', 'PostController@store')->name('post.store');

  Route::get('/admin/posts/{post}/edit', 'PostController@edit')->name('post.edit');
  Route::delete('/admin/posts/{post}/delete', 'PostController@destroy')->name('post.destroy');
  Route::patch('/admin/posts/{post}/update', 'PostController@update')->name('post.udpate');

  Route::get('admin/user/{user}/profile', 'UserController@show')->name('user.profile.show');
  Route::put('admin/user/{user}/update', 'UserController@update')->name('user.profile.update');

  Route::delete('admin/users/{user}/destroy', 'UserController@destroy')->name('user.destroy');
});

Route::middleware(['role:admin, view-dashboard'])->group(function(){
  Route::get('admin/users', 'UserController@index')->name('users.index');
});
 
// Route::get('/admin/posts/{post}/edit', 'PostController@edit')->middleware('can:view,post')->name('post.edit'); // policies applied

