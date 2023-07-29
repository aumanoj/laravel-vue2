<?php

use Illuminate\Support\Facades\Route;

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


// Route::get('/admin', function () {
//     // echo 'hello'; exit;
//     return redirect('/admin/login');
//     });

//for vue page
Route::get('/admin/{any?}', function () {
    return view('dashboard');
})->where('any', '.*');


//Route::get('/getOldOrderss/{order_id}', 'OrdersController@old_orders_show');
// Route::get('/getOldOrders', 'OrdersController@old_orders');
Auth::routes();
Route::get('generateReport', 'ReportController@orderDetailReportData');
//Route::get('sitemap.xml','SitemapController@index');
Route::get('brand-sitemap.xml','SitemapController@brands');
Route::get('model-sitemap.xml','SitemapController@models');    

Route::get('/confirm_wating_orders_gsmfather','CronController@confirm_wating_orders_gsmfather');
Route::get('/confirm_wating_orders_unlockseller','CronController@confirm_wating_orders_unlockseller');
Route::post('/register', 'RegisterController@register');
Route::post('/adminLogin', 'LoginController@login');
Route::post('/adminLogout', 'LoginController@logout');

Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@update');

//Paypal Controller
Route::get('payment/cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');
Route::post('paypal/notify', 'PayPalController@postnotify')->name('payment.notify');
Route::get('payment', 'PayPalController@payment')->name('payment');

//Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
//Route::get('payment/success', 'PayPalController@success')->name('payment.success');


Route::get('/getModelList/{brand_id}','AjaxController@getModelList');
Route::get('/getNetworkList/{CountryIds}','AjaxController@getNetworkList');

//Ajax Controller
Route::get('/getModelAjax/{brand_id}','AjaxController@getModelAjax');
Route::get('/getNetworkAjax/{country_id}','AjaxController@getNetworkAjax');
Route::get('/getCountryAjax','AjaxController@getCountryAjax');

Route::get('search', 'AjaxController@getallmodeldata');

//Pages Controller           
Route::get('/','PagesController@homePage');
Route::get('unlock-{brand_name}+phone', 'PagesController@brandPage');
Route::get('thankyou', 'PagesController@thankyou');
Route::get('/unlock-{brand_name}+{model_name}','PagesController@CountryNetworkPage');
Route::post('/order','PagesController@Order');
Route::post('/oldorder','PagesController@Order');
Route::post('/customerordermoneris','PagesController@customerordermoneris');
Route::post('/order/payment','PagesController@payment');
Route::get('payment_fail', 'PagesController@orderPayCancel');
Route::get('/pages/display/{page}','CmsController@index');


Route::get('/clients/login','ClientController@login')->name('login');
Route::post('/clients/login','ClientController@process_login');

Route::get('/clients/forgotpassword','ClientController@forgotPwd');
Route::post('/clients/forgotpassword','ClientController@forgotPassword');

Route::get('/clients/logout','ClientController@logout');
Route::get('/dashboard','DashBoardController@index');
Route::post('/dashboard/update/{id}/{imei}','DashBoardController@update');


Route::get('/contacts', 'PagesController@contact');
Route::post('/contacts', 'PagesController@contactPost');
Route::get('/top_apps', 'PagesController@top_apps');
