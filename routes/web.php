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

Route::get('/', function() {
//    return redirect('/dashboard');
    return view('Admin.login');
});
//Registration Form Start
Route::get('/signup', function() {
    return view('Admin.register');
});
Route::post('/signup/save', 'Admin\AdminController@signup')->name('/signup/save');
Route::post('/signup/validataion', 'Admin\AdminController@validation');
//Registration form End

//Forgot email or password
Route::get('/forgot', function() {
    return view('Admin.forgot');
});
Route::post('/forgot/verify', 'Admin\AdminController@forgot');
Route::get('/forgot/change_password/{code}', 'Admin\AdminController@change_password');
Route::get('/forgot/change_password',function(){
    return view('Admin.change_password');
});
Route::post('/forgot/change', 'Admin\AdminController@change');
//
Route::get('/login', function() {
    return view('Admin.login');
});

Route::post('/login', 'Admin\AdminController@login');


//Route::get('/', 'Admin\DashboardController@index');
Route::get('/dashboard', 'Admin\DashboardController@index');

Route::post('/client_search', 'Admin\DashboardController@client_name_search');

Route::post('/financial_year', 'Admin\DashboardController@financial_year');

Route::post('/month_quarter', 'Admin\DashboardController@month_quarter');

Route::post('/upload_file', 'Admin\DashboardController@upload_file');

Route::post('/platfrom_change', 'Admin\DashboardController@platfrom_change');

Route::get('/tablelist', function() {

    return view('Admin.Dashboard.table_list');
});
Route::post('/sales_table', 'Admin\DashboardController@sales_table_data');
Route::post('/sales_return_table', 'Admin\DashboardController@sales_return_table_data');

//Route::get('/reporting', function() {
//    
//    return view('Admin.Dashboard.reporting');
//});

Route::get('/reporting', 'Admin\DashboardController@reporting');

Route::post('/reporting_sales', 'Admin\DashboardController@reporting_data');
Route::post('/reporting_sales_return', 'Admin\DashboardController@reporting_sales_return_data');

Route::post('/savesession', 'Admin\DashboardController@save_session');

//     User Routes Start
//    Route::post('/email_check', 'Admin\UserController@email_check');
    Route::get('/clients', 'Admin\ClientController@index');
    Route::post('/clients/add', 'Admin\ClientController@add');
    Route::post('/clients/edit', 'Admin\ClientController@edit');
    Route::post('/clients/update', 'Admin\ClientController@update');
    Route::post('/clients/delete', 'Admin\ClientController@delete');
    Route::post('/clients/gettable', 'Admin\ClientController@client_data_table');
//     User Routes End


Route::get('/logout', function() {

    Auth::logout();
    return Redirect::to('/');
});
//});
