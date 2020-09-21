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

Route::get('admin/categories/list', 'Admin\CategoriesController@list_records')->name('categories.list')->middleware('auth');
Route::get('admin/category/add', 'Admin\CategoriesController@add_form')->name('category.add')->middleware('auth');
Route::post('admin/category/create', 'Admin\CategoriesController@create_record')->name('category.create')->middleware('auth');
Route::get('admin/category/edit/{id}', 'Admin\CategoriesController@edit_form')->name('category.edit')->middleware('auth');
Route::post('admin/category/update', 'Admin\CategoriesController@update_record')->name('category.update')->middleware('auth');
Route::get('admin/category/status/update', 'Admin\CategoriesController@change_status')->name('category.status')->middleware('auth');
Route::post('admin/category/del', 'Admin\CategoriesController@del_record')->name('category.del')->middleware('auth');

//Tags Routes

Route::get('admin/tags/list', 'Admin\TagsController@list_records')->name('tags.list')->middleware('auth');
Route::get('admin/tag/add', 'Admin\TagsController@add_form')->name('tag.add')->middleware('auth');
Route::post('admin/tag/create', 'Admin\TagsController@create_record')->name('tag.create')->middleware('auth');
Route::get('admin/tag/edit/{id}', 'Admin\TagsController@edit_form')->name('tag.edit')->middleware('auth');
Route::post('admin/tag/update', 'Admin\TagsController@update_record')->name('tag.update')->middleware('auth');
Route::get('admin/tag/status/update', 'Admin\TagsController@change_status')->name('tag.status')->middleware('auth');
Route::post('admin/tag/del', 'Admin\TagsController@del_record')->name('tag.del')->middleware('auth');

//Services Routes

Route::get('admin/services/list', 'Admin\ServicesController@list_records')->name('services.list')->middleware('auth');
Route::get('admin/service/add', 'Admin\ServicesController@add_form')->name('service.add')->middleware('auth');
Route::post('admin/service/create', 'Admin\ServicesController@create_record')->name('service.create')->middleware('auth');
Route::get('admin/service/edit/{id}', 'Admin\ServicesController@edit_form')->name('service.edit')->middleware('auth');
Route::post('admin/service/update', 'Admin\ServicesController@update_record')->name('service.update')->middleware('auth');
Route::get('admin/service/status/update', 'Admin\ServicesController@change_status')->name('service.status')->middleware('auth');
Route::post('admin/service/del', 'Admin\ServicesController@del_record')->name('service.del')->middleware('auth');

//Payment Methods Routes

Route::get('admin/paymentmethods/list', 'Admin\PaymentMethodsController@list_records')->name('paymentmethods.list')->middleware('auth');
Route::get('admin/paymentmethod/add', 'Admin\PaymentMethodsController@add_form')->name('paymentmethod.add')->middleware('auth');
Route::post('admin/paymentmethod/create', 'Admin\PaymentMethodsController@create_record')->name('paymentmethod.create')->middleware('auth');
Route::get('admin/paymentmethod/edit/{id}', 'Admin\PaymentMethodsController@edit_form')->name('paymentmethod.edit')->middleware('auth');
Route::post('admin/paymentmethod/update', 'Admin\PaymentMethodsController@update_record')->name('paymentmethod.update')->middleware('auth');
Route::get('admin/paymentmethod/status/update', 'Admin\PaymentMethodsController@change_status')->name('paymentmethod.status')->middleware('auth');
Route::post('admin/paymentmethod/del', 'Admin\PaymentMethodsController@del_record')->name('paymentmethod.del')->middleware('auth');

//Membership plans Routes

Route::get('admin/membershipplan/list', 'Admin\MembershipPlansController@list_records')->name('membershipplan.list')->middleware('auth');
Route::get('admin/membershipplan/add', 'Admin\MembershipPlansController@add_form')->name('membershipplan.add')->middleware('auth');
Route::post('admin/membershipplan/create', 'Admin\MembershipPlansController@create_record')->name('membershipplan.create')->middleware('auth');
Route::get('admin/membershipplan/edit/{id}', 'Admin\MembershipPlansController@edit_form')->name('membershipplan.edit')->middleware('auth');
Route::post('admin/membershipplan/update', 'Admin\MembershipPlansController@update_record')->name('membershipplan.update')->middleware('auth');
Route::get('admin/membershipplan/status/update', 'Admin\MembershipPlansController@change_status')->name('membershipplan.status')->middleware('auth');
Route::post('admin/membershipplan/del', 'Admin\MembershipPlansController@del_record')->name('membershipplan.del')->middleware('auth');

//CMS Pages Routes

Route::get('admin/cmspages/list', 'Admin\CmsPagesController@list_records')->name('cmspages.list')->middleware('auth');
Route::get('admin/cmspage/add', 'Admin\CmsPagesController@add_form')->name('cmspage.add')->middleware('auth');
Route::post('admin/cmspage/create', 'Admin\CmsPagesController@create_record')->name('cmspage.create')->middleware('auth');
Route::get('admin/cmspage/edit/{id}', 'Admin\CmsPagesController@edit_form')->name('cmspage.edit')->middleware('auth');
Route::post('admin/cmspage/update', 'Admin\CmsPagesController@update_record')->name('cmspage.update')->middleware('auth');
Route::get('admin/cmspage/status/update', 'Admin\CmsPagesController@change_status')->name('cmspage.status')->middleware('auth');
Route::post('admin/cmspage/del', 'Admin\CmsPagesController@del_record')->name('cmspage.del')->middleware('auth');