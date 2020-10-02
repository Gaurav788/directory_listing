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

Route::get('/redirect', 'SocialAuthLinkedinController@redirect');
Route::get('/callback', 'SocialAuthLinkedinController@callback');


/*****************
******************
Admin panel routes 
******************
******************/


Route::post('admin/details/update', 'Admin\AdminDashboardController@update_record')->name('admin.details.update')->middleware('admin');
Route::post('admin/password/update', 'Admin\AdminDashboardController@update_password')->name('admin.password.update')->middleware('admin');

//Manage Users Routes

Route::get('admin/users/list', 'Admin\UserManageController@list_records')->name('users.list')->middleware('admin');
Route::get('admin/user/status/update', 'Admin\UserManageController@change_status')->name('user.status')->middleware('admin');
Route::get('admin/user/edit/{id}', 'Admin\UserManageController@edit_form')->name('user.edit')->middleware('admin');
Route::post('admin/user/update', 'Admin\UserManageController@update_record')->name('user.update')->middleware('admin');
Route::get('admin/user/changepassword/{id}', 'Admin\UserManageController@change_password')->name('user.changepassword')->middleware('admin');
Route::post('admin/user/updatepassword', 'Admin\UserManageController@update_password')->name('user.updatepassword')->middleware('admin');
Route::post('admin/user/del', 'Admin\UserManageController@del_record')->name('user.del')->middleware('admin');

//Categories Routes

Route::get('admin/categories/list', 'Admin\CategoriesController@list_records')->name('categories.list')->middleware('admin');
Route::get('admin/category/add', 'Admin\CategoriesController@add_form')->name('category.add')->middleware('admin');
Route::post('admin/category/create', 'Admin\CategoriesController@create_record')->name('category.create')->middleware('admin');
Route::get('admin/category/edit/{id}', 'Admin\CategoriesController@edit_form')->name('category.edit')->middleware('admin');
Route::post('admin/category/update', 'Admin\CategoriesController@update_record')->name('category.update')->middleware('admin');
Route::get('admin/category/status/update', 'Admin\CategoriesController@change_status')->name('category.status')->middleware('admin');
Route::post('admin/category/del', 'Admin\CategoriesController@del_record')->name('category.del')->middleware('admin');

//Currencies Routes

Route::get('admin/currencies/list', 'Admin\CurrencyController@list_records')->name('currencies.list')->middleware('admin');
Route::get('admin/currency/add', 'Admin\CurrencyController@add_form')->name('currency.add')->middleware('admin');
Route::post('admin/currency/create', 'Admin\CurrencyController@create_record')->name('currency.create')->middleware('admin');
Route::get('admin/currency/edit/{id}', 'Admin\CurrencyController@edit_form')->name('currency.edit')->middleware('admin');
Route::post('admin/currency/update', 'Admin\CurrencyController@update_record')->name('currency.update')->middleware('admin');
Route::get('admin/currency/status/update', 'Admin\CurrencyController@change_status')->name('currency.status')->middleware('admin');
Route::post('admin/currency/del', 'Admin\CurrencyController@del_record')->name('currency.del')->middleware('admin');

//Tags Routes

Route::get('admin/tags/list', 'Admin\TagsController@list_records')->name('tags.list')->middleware('admin');
Route::get('admin/tag/add', 'Admin\TagsController@add_form')->name('tag.add')->middleware('admin');
Route::post('admin/tag/create', 'Admin\TagsController@create_record')->name('tag.create')->middleware('admin');
Route::get('admin/tag/edit/{id}', 'Admin\TagsController@edit_form')->name('tag.edit')->middleware('admin');
Route::post('admin/tag/update', 'Admin\TagsController@update_record')->name('tag.update')->middleware('admin');
Route::get('admin/tag/status/update', 'Admin\TagsController@change_status')->name('tag.status')->middleware('admin');
Route::post('admin/tag/del', 'Admin\TagsController@del_record')->name('tag.del')->middleware('admin');

//Services Routes

Route::get('admin/services/list', 'Admin\ServicesController@list_records')->name('services.list')->middleware('admin');
Route::get('admin/service/add', 'Admin\ServicesController@add_form')->name('service.add')->middleware('admin');
Route::post('admin/service/create', 'Admin\ServicesController@create_record')->name('service.create')->middleware('admin');
Route::get('admin/service/edit/{id}', 'Admin\ServicesController@edit_form')->name('service.edit')->middleware('admin');
Route::post('admin/service/update', 'Admin\ServicesController@update_record')->name('service.update')->middleware('admin');
Route::get('admin/service/status/update', 'Admin\ServicesController@change_status')->name('service.status')->middleware('admin');
Route::post('admin/service/del', 'Admin\ServicesController@del_record')->name('service.del')->middleware('admin');

//Payment Methods Routes

Route::get('admin/paymentmethods/list', 'Admin\PaymentMethodsController@list_records')->name('paymentmethods.list')->middleware('admin');
Route::get('admin/paymentmethod/add', 'Admin\PaymentMethodsController@add_form')->name('paymentmethod.add')->middleware('admin');
Route::post('admin/paymentmethod/create', 'Admin\PaymentMethodsController@create_record')->name('paymentmethod.create')->middleware('admin');
Route::get('admin/paymentmethod/edit/{id}', 'Admin\PaymentMethodsController@edit_form')->name('paymentmethod.edit')->middleware('admin');
Route::post('admin/paymentmethod/update', 'Admin\PaymentMethodsController@update_record')->name('paymentmethod.update')->middleware('admin');
Route::get('admin/paymentmethod/status/update', 'Admin\PaymentMethodsController@change_status')->name('paymentmethod.status')->middleware('admin');
Route::post('admin/paymentmethod/del', 'Admin\PaymentMethodsController@del_record')->name('paymentmethod.del')->middleware('admin');

//Membership plans Routes

Route::get('admin/membershipplan/list', 'Admin\MembershipPlansController@list_records')->name('membershipplan.list')->middleware('admin');
Route::get('admin/membershipplan/add', 'Admin\MembershipPlansController@add_form')->name('membershipplan.add')->middleware('admin');
Route::post('admin/membershipplan/create', 'Admin\MembershipPlansController@create_record')->name('membershipplan.create')->middleware('admin');
Route::get('admin/membershipplan/edit/{id}', 'Admin\MembershipPlansController@edit_form')->name('membershipplan.edit')->middleware('admin');
Route::post('admin/membershipplan/update', 'Admin\MembershipPlansController@update_record')->name('membershipplan.update')->middleware('admin');
Route::get('admin/membershipplan/status/update', 'Admin\MembershipPlansController@change_status')->name('membershipplan.status')->middleware('admin');
Route::post('admin/membershipplan/del', 'Admin\MembershipPlansController@del_record')->name('membershipplan.del')->middleware('admin');

//Payment Gateways Routes

Route::get('admin/paymentgateways/list', 'Admin\PaymentGatewaysController@list_records')->name('paymentgateways.list')->middleware('admin');
Route::get('admin/paymentgateway/add', 'Admin\PaymentGatewaysController@add_form')->name('paymentgateway.add')->middleware('admin');
Route::post('admin/paymentgateway/create', 'Admin\PaymentGatewaysController@create_record')->name('paymentgateway.create')->middleware('admin');
Route::get('admin/paymentgateway/edit/{id}', 'Admin\PaymentGatewaysController@edit_form')->name('paymentgateway.edit')->middleware('admin');
Route::post('admin/paymentgateway/update', 'Admin\PaymentGatewaysController@update_record')->name('paymentgateway.update')->middleware('admin');
Route::get('admin/paymentgateway/status/update', 'Admin\PaymentGatewaysController@change_status')->name('paymentgateway.status')->middleware('admin');
Route::post('admin/paymentgateway/del', 'Admin\PaymentGatewaysController@del_record')->name('paymentgateway.del')->middleware('admin');

//CMS Pages Routes

Route::get('admin/cmspages/list', 'Admin\CmsPagesController@list_records')->name('cmspages.list')->middleware('admin');
Route::get('admin/cmspage/add', 'Admin\CmsPagesController@add_form')->name('cmspage.add')->middleware('admin');
Route::post('admin/cmspage/create', 'Admin\CmsPagesController@create_record')->name('cmspage.create')->middleware('admin');
Route::get('admin/cmspage/edit/{id}', 'Admin\CmsPagesController@edit_form')->name('cmspage.edit')->middleware('admin');
Route::post('admin/cmspage/update', 'Admin\CmsPagesController@update_record')->name('cmspage.update')->middleware('admin');
Route::get('admin/cmspage/status/update', 'Admin\CmsPagesController@change_status')->name('cmspage.status')->middleware('admin');
Route::post('admin/cmspage/del', 'Admin\CmsPagesController@del_record')->name('cmspage.del')->middleware('admin');

//Contact us Routes

Route::get('admin/contactus/list', 'Admin\ContactUsController@list_records')->name('contactus.list')->middleware('admin');
Route::get('admin/contactus/status/update', 'Admin\ContactUsController@change_status')->name('contactus.status')->middleware('admin');
Route::post('admin/contactus/del', 'Admin\ContactUsController@del_record')->name('contactus.del')->middleware('admin');
Route::get('admin/contactus/reply/{id}', 'Admin\ContactUsController@reply')->name('contactus.reply')->middleware('admin');
Route::post('admin/contactus/replied', 'Admin\ContactUsController@replied')->name('contactus.replied')->middleware('admin');

//Testimonials Routes

Route::get('admin/testimonials/list', 'Admin\TestimonialsController@list_records')->name('testimonials.list')->middleware('admin');
Route::get('admin/testimonial/status/update', 'Admin\TestimonialsController@change_status')->name('testimonial.status')->middleware('admin');
Route::post('admin/testimonial/del', 'Admin\TestimonialsController@del_record')->name('testimonial.del')->middleware('admin');