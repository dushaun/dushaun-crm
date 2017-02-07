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

Route::get('/about', 'PageController@about');
Route::get('/services', 'PageController@services');
Route::get('/enquire', 'PageController@enquire');

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'crm', 'namespace' => 'Crm'], function () {
    Route::get('/', 'CrmController@index');

    Route::resource('clients', 'ClientController');

    Route::get('/contacts/create', 'ContactController@create');
    Route::post('/contacts', 'ContactController@store');
    Route::get('/contacts/{contact}', 'ContactController@show');
    Route::get('/contacts/{contact}/edit', 'ContactController@edit');
    Route::patch('/contacts/{contact}', 'ContactController@update');
    Route::delete('/contacts/{contact}', 'ContactController@delete');

    // View
    Route::get('/enquiries', 'EnquiryController@index');
    Route::get('/enquiries/{enquiry}', 'EnquiryController@show');
    // Functional
    Route::delete('/enquiries/{enquiry}', 'EnquiryController@delete');

    Route::resource('invoices', 'InvoiceController');

    Route::resource('jobs', 'JobController');
});

Route::get('invoices/{invoice}/payment', 'InvoicePaymentController@payment');
Route::patch('invoices/{invoice}/pay', 'InvoicePaymentController@pay');
Route::patch('invoices/{invoice}/transfer', 'InvoicePaymentController@transfer');
Route::get('invoices/{invoice}/paid', 'InvoicePaymentController@paid');
Route::patch('invoices/{invoice}/subscribe', 'InvoicePaymentController@subscribe');
Route::patch('invoices/{invoice}/finished', 'InvoicePaymentController@finished');
Route::get('invoices/completed', 'InvoicePaymentController@completed');
