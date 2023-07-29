<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/register', 'RegisterController@register');
// Route::post('/login', 'LoginController@login');
// Route::post('/logout', 'LoginController@logout');

// Route::get('change-password', 'ChangePasswordController@index');
// Route::post('change-password', 'ChangePasswordController@update')->name('change.password');

// Route::post('password/email', 'ForgotPasswordController@forgot');
// Route::post('password/reset', 'ForgotPasswordController@reset');

// Send reset password mail
Route::post('reset-password', 'ForgotPasswordController@sendPasswordResetLink');      
// handle reset password form process
Route::post('reset/password', 'ForgotPasswordController@callResetPassword');

//email verification
Route::get('/email/resend', 'VerificationController@resend')->name('verification.verify');
Route::get('email/verify/{id}/{hash}','VerificationController@verify')->name('verification.verify');

// for city
Route::get('/getCities', 'CitiesController@index');
Route::get('/getCountry', 'CitiesController@create');
Route::post('/storeCity','CitiesController@store');
Route::get('/editCity/{id}', 'CitiesController@edit');
Route::post('/updateCity/{id}', 'CitiesController@update');
Route::post('/deleteCity/{id}', 'CitiesController@destroy');


// for user
Route::get('/getUsers', 'UsersController@index');
Route::get('/getRole', 'UsersController@create');
Route::post('/createUser','UsersController@store');
Route::get('/editUser/{id}', 'UsersController@edit');
Route::post('/updateUser/{id}', 'UsersController@update');
Route::post('/deleteUser/{id}', 'UsersController@destroy');

Route::get('/editProfile/{id}', 'UsersController@editProfile');
Route::post('/updateProfile/{id}', 'UsersController@profile');

//Role
Route::get('/getRoles', 'RoleController@index');
Route::get('/getPermissions', 'RoleController@create');
Route::post('/createRole','RoleController@store');
Route::get('/editRole/{id}', 'RoleController@edit');
Route::post('/updateRole/{id}', 'RoleController@update');
Route::post('/deleteRole/{id}', 'RoleController@destroy');



Route::group(['middleware' => ['auth:api']], function() {
    // Route::resource('roles','RoleController');
    // Route::resource('users','UserController');
    // Route::resource('cities','CitiesController');
   
});

Route::get('/getModelList/{brand_id}','AjaxController@getModelList');
Route::get('/getMultipleModelList/{brandIds}','AjaxController@getMultipleModelList');

Route::get('/getNetworkList/{CountryIds}','AjaxController@getNetworkList');

// orders controller
Route::get('/getOrders', 'OrdersController@index');
Route::get('/getOldOrders', 'OrdersController@old_orders');
Route::get('/getOrder/{order_id}', 'OrdersController@show');
Route::get('/getOldOrders/{order_id}', 'OrdersController@old_orders_show');
Route::post('/search','OrdersController@search');
Route::get('/reprocess/{toolid}/{orderid}','OrdersController@re_process');
Route::get('/gettools','OrdersController@gettools');
Route::get('/gettoolsseller','OrdersController@gettoolsseller');
Route::post('/order_comment','OrdersController@order_comment');
Route::get('/refund/{orderid}','PayPalController@refund');

Route::post('/old_search','OrdersController@old_search');


//brand controller
Route::get('/getBrands', 'ManufacturerController@index');
Route::post('/searchBrand','ManufacturerController@search');
Route::post('/createBrand', 'ManufacturerController@store');
Route::get('/editBrand/{id}', 'ManufacturerController@edit');
Route::post('/updateBrand/{id}', 'ManufacturerController@update');
Route::post('/deleteBrand/{id}', 'ManufacturerController@destroy');

//Brand content controller
Route::get('/getBrandContent', 'BrandContentController@index');
Route::get('/getBrandsCont', 'BrandContentController@getBrands');
Route::post('/searchBrandContent', 'BrandContentController@search');
Route::post('/createBrandContent', 'BrandContentController@store');
Route::get('/editBrandContent/{id}', 'BrandContentController@edit');
Route::post('/updateBrandContent/{id}', 'BrandContentController@update');
Route::post('/deleteBrandContent/{id}', 'BrandContentController@destroy');

//Model content controller
Route::get('/getModelContent', 'ModelContentController@index');
Route::post('/getModelContent', 'ModelContentController@index');
Route::get('/getBrandCont', 'ModelContentController@getBrands');
Route::get('/getModelCont', 'ModelContentController@getModels');
Route::post('/searchModelContent', 'ModelContentController@search');
Route::post('/createModelContent', 'ModelContentController@store');
Route::get('/editModelContent/{id}', 'ModelContentController@edit');
Route::post('/updateModelContent/{id}', 'ModelContentController@update');
Route::post('/deleteModelContentImg/{id}', 'ModelContentController@imageDelete');
Route::post('/deleteModelContent/{id}', 'ModelContentController@destroy');

//Assets controller
Route::get('/getAsset', 'AssetsController@index');
Route::post('/createAsset', 'AssetsController@store');
Route::get('/editAsset/{id}', 'AssetsController@edit');
Route::post('/updateAsset/{id}', 'AssetsController@update');
Route::post('/deleteAsset/{id}', 'AssetsController@destroy');

//model controller
Route::get('/getModels', 'ModelController@index');
Route::post('/getModels','ModelController@index');
Route::post('/searchModel','ModelController@search');
Route::get('/getBrand', 'ModelController@getBrands');
Route::post('/createModel', 'ModelController@store');
Route::get('/editModel/{id}', 'ModelController@edit');
Route::post('/updateModel/{id}', 'ModelController@update');

//tools controller
Route::get('/tools','ToolsController@index');
Route::post('/searchTool','ToolsController@search');
Route::post('/createTool','ToolsController@store');
Route::get('/editTool/{id}','ToolsController@edit');
Route::post('/updateTool/{id}','ToolsController@update');
Route::get('/getVendor','ToolsController@getVendors');
Route::get('/check-missing-tools','ToolsController@missingToolsID');
Route::get('/getToolData/{toolID}','ToolsController@getToolData');
Route::get('/getApiPrice/{toolID}','ToolsController@getApiPrice');

//toolsSelections controller
Route::get('/toolSelections','ToolsSelectionsController@index');

//Reports

Route::get('getReportData', 'ReportController@getReportData');
Route::get('topOrdersSave', 'ReportController@topOrdersSave');
Route::get('topOrdersView', 'ReportController@topOrdersView');
Route::post('generateReportData', 'ReportController@orderDetailReport');
Route::post('generateReportDataExcel',
	'ReportController@orderDetailReportExcel');
Route::get('/getOrderDetailContent', 
	'ReportController@orderDetailReportContents');

Route::get('getCountryList','AjaxController@getCountryList');
Route::get('getUserCountryList','AjaxController@getUserCountryList');

Route::get('/createToolSelections','ToolsSelectionsController@create');
Route::post('/storeToolSel','ToolsSelectionsController@store');
Route::post('/updateToolSel/{id}','ToolsSelectionsController@update');
Route::post('/searchToolSelection','ToolsSelectionsController@search');
Route::get('/editToolSelections/{id}','ToolsSelectionsController@edit');

//cronsSelections controller
Route::get('/confirm_wating_orders_gsmfather','CronController@confirm_wating_orders_gsmfather');

Route::get('orders-email-verify','OrdersController@verify_email_clear_out');