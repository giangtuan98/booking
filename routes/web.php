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
    return view('page.index');
});
Route::get('trang-chu', [
	'as' => 'index',
	'uses' => 'PageController@getIndex'
]);
Route::get('huong-dan-mua-ve', [
	'as' => 'ticket-purchase-guide',
	'uses' => 'PageController@getHuongDanMuaVe'
]);
Route::post('dat-ve', [
	'as' => 'booking',
	'uses' => 'PageController@postBookingTicket'
]);
Route::get('dat-ve', [
	'as' => 'booking',
	'uses' => 'PageController@getBookingTicket'
]);
Route::get('bang-gia', [
	'as' => 'price-table',
	'uses' => 'PageController@getPriceTable'
]);
Route::post('bang-gia', [
	'as' => 'price-table',
	'uses' => 'PageController@postPriceTable'
]);
Route::get('getLienHe', [
	'as' => 'getLienHe',
	'uses' => 'SendEmailController@getLienHe'
]);
Route::post('sendConfirmCodeText', [
	'as' => 'sendConfirmCodeText',
	'uses' => 'SendEmailController@sendConfirmCodeText'
]);
// Route::post('lien-he', [
// 	'as' => 'postLienHe',
// 	'uses' => 'PageController@postLienHe'
// ]);
/// ******** Admin route *************


Route::get('admin', [
	'as' => 'admin',
	'uses' => 'AdminController@getAdmin'
]);
Route::get('admin/ve-xe', [
	'as' => 'ticket',
	'uses' => 'AdminController@getTicketTable'
]);
Route::get('admin/tuyen-xe', [
	'as' => 'route',
	'uses' => 'AdminController@getRouteTable'
]);
Route::get('admin/chuyen-xe', [
	'as' => 'buses',
	'uses' => 'AdminController@getBusesTable'
]);
Route::get('admin/diem', [
	'as' => 'place',
	'uses' => 'AdminController@getPlaceTable'
]);
Route::get('admin/khach-hang', [
	'as' => 'passenger',
	'uses' => 'AdminController@getPassengerTable'
]);
Route::get('admin/login', [
	'as' => 'login',
	'uses' => 'AdminController@getLogin'
]);
Route::post('admin/login', [
	'as' => 'login',
	'uses' => 'AdminController@postLogin'
]);
Route::get('admin/logout', [
	'as' => 'logout',
	'uses' => 'AdminController@getLogout'
]);
Route::get('admin/chi-tiet-chuyen-xe', [
	'as' => 'buses_detail',
	'uses' => 'AdminController@getBusesDetail'
]);
Route::get('admin/tai-khoan', [
	'as' => 'users',
	'uses' => 'AdminController@getUser'
]);

Route::get('admin/tao-du-lieu-thang-sau', [
	'as' => 'create_data_next',
	'uses' => 'AdminController@createDataNext'
]);
Route::get('admin/tao-du-lieu-thang-nay', [
	'as' => 'create_data_this',
	'uses' => 'AdminController@createDataThis'
]);

// ************ Ajax Route************* 
Route::post('admin/addPlace', [
	'as' => 'addPlace',
	'uses' => 'AjaxController@postAddPlace'
]);
Route::post('admin/delPlace', [
	'as' => 'delPlace',
	'uses' => 'AjaxController@postDelPlace'
]);
Route::post('admin/updatePlace', [
	'as' => 'updatePlace',
	'uses' => 'AjaxController@postUpdatePlace'
]);
Route::post('admin/delRoute', [
	'as' => 'delRoute',
	'uses' => 'AjaxController@postDelRoute'
]);
Route::post('admin/addRoute', [
	'as' => 'addRoute',
	'uses' => 'AjaxController@postAddRoute'
]);
Route::post('admin/updateRoute', [
	'as' => 'updateRoute',
	'uses' => 'AjaxController@postUpdateRoute'
]);
Route::post('admin/delBuses', [
	'as' => 'delBuses',
	'uses' => 'AjaxController@postDelBuses'
]);
Route::post('admin/addBuses', [
	'as' => 'addBuses',
	'uses' => 'AjaxController@postAddBuses'
]);
Route::post('admin/updateBuses', [
	'as' => 'updateBuses',
	'uses' => 'AjaxController@postUpdateBuses'
]);
Route::post('admin/delUser', [
	'as' => 'delUser',
	'uses' => 'AjaxUserController@postDelUser'
]);
Route::post('admin/addUser', [
	'as' => 'addUser',
	'uses' => 'AjaxUserController@postAddUser'
]);
Route::post('admin/updateUser', [
	'as' => 'updateUser',
	'uses' => 'AjaxUserController@postUpdateUser'
]);
Route::post('admin/changePassword', [
	'as' => 'changePassword',
	'uses' => 'AjaxUserController@postChangePassword'
]);
Route::get('getCookie', [
	'as' => 'getCookie',
	'uses' => 'PageController@getCookie'
]);
Route::get('setCookie', [
	'as' => 'setCookie',
	'uses' => 'PageController@setCookie'
]);