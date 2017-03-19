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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


// STATIC STORAGE FILES
Route::get('public/{dir}/{file}', 'StaticFileController@show')->middleware('auth');

Route::get('public/{dir}/thb/{file}', 'StaticFileController@showThb')->middleware('auth');


// FAMILIES

// Admin dashboard
Route::get('directory/dashboard', 'FamilyController@dashboard');

Route::get('directory', 'FamilyController@index');

Route::get('directory/{family_slug}', 'FamilyController@show');

// Photo upload
Route::post('directory/{family_id}/photo', 'FamilyController@addPhoto');

// All other resource routes
Route::resource('families', 'FamilyController');


// MEMBERS
Route::resource('members', 'MemberController');
