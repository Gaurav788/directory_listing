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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/dashboard', 'Admin\AdminDashboardController@index')->name('admin.dashboard')->middleware('admin');
Route::get('/user/dashboard', 'User\UserDashboardController@index')->name('user.dashboard')->middleware('user');



/*****************
******************
Admin panel routes 
******************
******************/


//Categories Routes

Route::get('admin/categories/list', 'Admin\CategoriesController@list_records')->name('categories.list');
Route::get('admin/category/add', 'Admin\CategoriesController@add_form')->name('category.add');
Route::post('admin/category/create', 'Admin\CategoriesController@create_record')->name('category.create');
Route::get('admin/category/edit/{id}', 'Admin\CategoriesController@edit_form')->name('category.edit');
Route::post('admin/category/update', 'Admin\CategoriesController@update_record')->name('category.update');
Route::get('admin/category/status/update', 'Admin\CategoriesController@change_status')->name('category.status');
Route::post('admin/category/del', 'Admin\CategoriesController@del_record')->name('category.del');

//Tags Routes

Route::get('admin/tags/list', 'Admin\TagsController@list_records')->name('tags.list');
Route::get('admin/tag/add', 'Admin\TagsController@add_form')->name('tag.add');
Route::post('admin/tag/create', 'Admin\TagsController@create_record')->name('tag.create');
Route::get('admin/tag/edit/{id}', 'Admin\TagsController@edit_form')->name('tag.edit');
Route::post('admin/tag/update', 'Admin\TagsController@update_record')->name('tag.update');
Route::get('admin/tag/status/update', 'Admin\TagsController@change_status')->name('tag.status');
Route::post('admin/tag/del', 'Admin\TagsController@del_record')->name('tag.del');

//Services Routes

Route::get('admin/services/list', 'Admin\ServicesController@list_records')->name('services.list');
Route::get('admin/service/add', 'Admin\ServicesController@add_form')->name('service.add');
Route::post('admin/service/create', 'Admin\ServicesController@create_record')->name('service.create');
Route::get('admin/service/edit/{id}', 'Admin\ServicesController@edit_form')->name('service.edit');
Route::post('admin/service/update', 'Admin\ServicesController@update_record')->name('service.update');
Route::get('admin/service/status/update', 'Admin\ServicesController@change_status')->name('service.status');
Route::post('admin/service/del', 'Admin\ServicesController@del_record')->name('service.del');

//Payment Methods Routes

Route::get('admin/paymentmethods/list', 'Admin\PaymentMethodsController@list_records')->name('paymentmethods.list');
Route::get('admin/paymentmethod/add', 'Admin\PaymentMethodsController@add_form')->name('paymentmethod.add');
Route::post('admin/paymentmethod/create', 'Admin\PaymentMethodsController@create_record')->name('paymentmethod.create');
Route::get('admin/paymentmethod/edit/{id}', 'Admin\PaymentMethodsController@edit_form')->name('paymentmethod.edit');
Route::post('admin/paymentmethod/update', 'Admin\PaymentMethodsController@update_record')->name('paymentmethod.update');
Route::get('admin/paymentmethod/status/update', 'Admin\PaymentMethodsController@change_status')->name('paymentmethod.status');
Route::post('admin/paymentmethod/del', 'Admin\PaymentMethodsController@del_record')->name('paymentmethod.del');

//Payment Methods Routes

Route::get('admin/membershipplan/list', 'Admin\MembershipPlansController@list_records')->name('membershipplan.list');
Route::get('admin/membershipplan/add', 'Admin\MembershipPlansController@add_form')->name('membershipplan.add');
Route::post('admin/membershipplan/create', 'Admin\MembershipPlansController@create_record')->name('membershipplan.create');
Route::get('admin/membershipplan/edit/{id}', 'Admin\MembershipPlansController@edit_form')->name('membershipplan.edit');
Route::post('admin/membershipplan/update', 'Admin\MembershipPlansController@update_record')->name('membershipplan.update');
Route::get('admin/membershipplan/status/update', 'Admin\MembershipPlansController@change_status')->name('membershipplan.status');
Route::post('admin/membershipplan/del', 'Admin\MembershipPlansController@del_record')->name('membershipplan.del');