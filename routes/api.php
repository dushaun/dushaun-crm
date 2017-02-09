<?php

use Illuminate\Http\Request;

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

Route::get('/products', 'Crm\Api\EnquiryApiController@getProducts');
Route::post('/enquiry/submit', 'Crm\Api\EnquiryApiController@submitEnquiry');

Route::group(['namespace' => 'Crm\Api', 'prefix' => 'crm/clients'], function () {
    Route::get('/index', 'ClientApiController@index');
});

Route::group(['namespace' => 'Crm\Api', 'prefix' => 'crm/enquiries'], function () {
    Route::get('/index', 'EnquiryApiController@index');
    Route::get('/show', 'EnquiryApiController@show');
    Route::patch('/read', 'EnquiryApiController@read');
    Route::patch('/reject', 'EnquiryApiController@reject');
    Route::patch('/accept', 'EnquiryApiController@accept');
    Route::patch('/convert/client', 'EnquiryApiController@convert');
});

Route::group(['namespace' => 'Crm\Api', 'prefix' => 'crm/jobs'], function () {
    Route::get('/client', 'JobApiController@client');
});