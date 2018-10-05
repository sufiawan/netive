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
    return Redirect::to( '/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('accesspoint', 'AccessPointController');
// Route::get('/accesspoint//{accesspoint}/', 'HomeController@index')->name('home');

Route::resource('bandwidthmanagement', 'BandwidthManagementController');

Route::resource('firewall', 'FirewallController');

Route::resource('gateway', 'GatewayController');

Route::resource('router', 'RouterController');

Route::resource('server', 'ServerController');

Route::resource('coreswitch', 'CoreSwitchController');

Route::resource('manageableswitch', 'ManageableSwitchController');

Route::resource('unmanageableswitch', 'UnmanageableSwitchController');

Route::resource('virtuallan', 'VirtualLANController');

Route::resource('enddevice', 'EndDeviceController');
