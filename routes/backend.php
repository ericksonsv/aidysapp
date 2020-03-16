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