<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{post}', 'PostController@show')->name('post');

Route::middleware('auth')->group(function(){
  Route::get('/admin', 'AdminController@index')->name('admin.index');
  // posts
  Route::get('/admin/posts', 'PostController@index')->name('post.index');
  Route::get('/admin/posts/create', 'PostController@create')->name('post.create');
  Route::post('/admin/posts', 'PostController@store')->name('post.store');
  Route::get('/admin/posts/{post}/edit', 'PostController@edit')->name('post.edit');
  Route::delete('/admin/posts/{post}/delete', 'PostController@destroy')->name('post.destroy');
  Route::patch('/admin/posts/{post}/update', 'PostController@update')->name('post.udpate');

  // users
  Route::get('admin/user/{user}/profile', 'UserController@show')->name('user.profile.show');
  Route::put('admin/user/{user}/update', 'UserController@update')->name('user.profile.update');
  Route::delete('admin/users/{user}/destroy', 'UserController@destroy')->name('user.destroy');

  // roles
  Route::get('admin/roles', 'RoleController@index')->name('roles.index');
  Route::post('admin/roles', 'RoleController@store')->name('roles.store');
  Route::delete('admin/roles/{role}/destroy', 'RoleController@destroy')->name('roles.destroy');
  Route::get('admin/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
  Route::put('admin/roles/{role}/update', 'RoleController@update')->name('roles.update');
  Route::get('/admin/roles/{role}/attach', 'RoleController@attach_permission')->name('role.permission.attach');
  Route::get('/admin/roles/{role}/detach', 'RoleController@detach')->name('role.permission.detach');

  // permissions
  Route::get('admin/permissions', 'PermissionController@index')->name('permissions.index');
  Route::post('admin/permissions', 'PermissionController@store')->name('permissions.store');
  Route::delete('admin/permissions/{permission}/destroy', 'PermissionController@destroy')->name('permissions.destroy');
  Route::get('admin/permissions/{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
  Route::put('admin/permissions/{permission}/update', 'PermissionController@update')->name('permissions.update');
});

Route::middleware(['role:admin', 'auth'])->group(function(){
  Route::get('admin/users', 'UserController@index')->name('users.index');
  Route::get('admin/users/{user}/attach', 'UserController@attach')->name('user.role.attach');
  Route::get('admin/users/{user}/detach', 'UserController@detach')->name('user.role.detach');

});
 
// Route::get('/admin/posts/{post}/edit', 'PostController@edit')->middleware('can:view,post')->name('post.edit'); // policies applied

