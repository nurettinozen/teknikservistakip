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


// Home Routers
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

// Auth Routers
Auth::routes();

// Customer Routers
Route::resource('customers', 'CustomerController');

// Brand Routers
Route::resource('brands', 'BrandController');

// Modelling Routers
Route::resource('modellings', 'ModellingController');

// Component Routers
Route::resource('components', 'ComponentController');
Route::get('getModels', 'ComponentController@getModels');

// Device Routers
Route::resource('devices', 'DeviceController');
Route::get('showBarcode', 'DeviceController@showBarcode');
Route::get('showForm', 'DeviceController@showForm');

