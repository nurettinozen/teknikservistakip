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
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

//// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Customer Routes
Route::resource('customers', 'CustomerController');

// Brand Routes
Route::resource('brands', 'BrandController');

// Modelling Routes
Route::resource('modellings', 'ModellingController');

// Component Routes
Route::resource('components', 'ComponentController');
Route::get('getModels', 'ComponentController@getModels');

// Device Routes
Route::resource('devices', 'DeviceController');
Route::get('showBarcode', 'DeviceController@showBarcode');
Route::get('showForm', 'DeviceController@showForm');
Route::patch('startService/{barcode}','DeviceController@start')->name('service.start');

// Service Routers
Route::resource('services', 'ServiceController');
Route::get('finish-services', 'ServiceController@finish');

// Status Changer Controller Routes
Route::patch('sendCenter/{barcode}', 'StatusController@send_center')->name('send.center');
Route::patch('repairStart/{barcode}', 'StatusController@repair_start')->name('repair.start');
Route::patch('componentsWaiting/{barcode}', 'StatusController@components_waiting')->name('components.waiting');
Route::patch('confirmWaiting/{barcode}', 'StatusController@confirm_waiting')->name('confirm.waiting');
Route::patch('shipping/{barcode}', 'StatusController@shipping')->name('device.shipping');
Route::patch('delivered/{barcode}', 'StatusController@delivered')->name('device.delivered');
Route::patch('deviceReady/{barcode}', 'StatusController@device_ready')->name('device.ready');

// Search Routes
Route::get('search', 'SearchController@index');

Route::post('search/barcode', 'SearchController@barcode')->name('search.barcode');
Route::post('search/serial', 'SearchController@serial')->name('search.serial');
