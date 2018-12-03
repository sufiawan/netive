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

Route::resource('bandwidthmanagement', 'BandwidthManagementController');

Route::resource('firewall', 'FirewallController');

Route::resource('gateway', 'GatewayController');

Route::resource('router', 'RouterController');

Route::resource('server', 'ServerController');

Route::resource('virtualserver', 'VirtualServerController');

Route::get('networkdevice/show/{typeid}', 'NetworkSwitchController@ShowAvailableNetwokDevice');
Route::get('networkswitch/showport/{id}', 'NetworkSwitchController@ShowAvailableSwitchPort');
Route::get('networkswitch/showip/{vlanid}', 'NetworkSwitchController@ShowAvailableIPAddress');
Route::post('networkswitch/setport', 'NetworkSwitchController@SetPort');
Route::post('networkswitch/setdevice', 'NetworkSwitchController@SetDevice');
Route::post('networkswitch/unsetdevice', 'NetworkSwitchController@unsetDevice');
Route::resource('networkswitch', 'NetworkSwitchController');

Route::resource('switchport', 'SwitchPortController');

Route::resource('virtuallan', 'VirtualLANController');

Route::resource('enddevice', 'EndDeviceController');

Route::put('user/changepassword', 'UserController@changepassword');
Route::resource('user', 'UserController');