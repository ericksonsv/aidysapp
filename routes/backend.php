<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web backend routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication
Route::get('login','Auth\LoginController@showLoginForm')->name('backend.login');
Route::post('login','Auth\LoginController@login');
Route::post('logout','Auth\LoginController@logout')->name('backend.logout');

// Dashboard
Route::get('/','DashboardController@index')->name('backend.dashboard');

// Profile
Route::get('profile/show','ProfileController@show')->name('backend.profile.show');
Route::get('profile/edit','ProfileController@edit')->name('backend.profile.edit');
Route::patch('profile','ProfileController@update')->name('backend.profile.update');
Route::post('profile/delete-avatar','ProfileController@deleteAvatar')->name('backend.profile.delete-avatar');
Route::post('profile/delete-cover','ProfileController@deleteCover')->name('backend.profile.delete-cover');

// Users
Route::resource('users','UserController',['names' => 'backend.users']);
// Route::post('users/{id}/change-status','UserController@changeStatus')->name('backend.users.change-status');
Route::post('users/{id}/delete-avatar','UserController@deleteAvatar')->name('backend.users.delete-avatar');
Route::post('users/{id}/delete-cover','UserController@deleteCover')->name('backend.users.delete-cover');

// Roles
Route::resource('roles','RoleController',['names' => 'backend.roles']);

// Categories
Route::resource('categories','CategoryController',['names' => 'backend.categories']);

// Posts
Route::resource('posts','PostController',['names' => 'backend.posts']);
Route::post('post/{id}/delete-image','PostController@deleteImage')->name('backend.posts.delete-image');
Route::post('post/{id}/delete-video','PostController@deleteVideo')->name('backend.posts.delete-video');

// tags
Route::resource('tags','TagController', ['names' => 'backend.tags']);