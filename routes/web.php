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

Auth::routes();

// Home, All diretory index
Route::get('/', 'FamilyController@index');

// All other resource routes
Route::resource('family', 'FamilyController');

// Admin dashboard
Route::get('admin', 'FamilyController@admin');


// Member resources
Route::resource('members', 'MemberController');


// Static, storage files
Route::get('public/{dir}/{file}', 'StaticFileController@show')->middleware('auth');

Route::get('public/{dir}/thb/{file}', 'StaticFileController@showThb')->middleware('auth');
