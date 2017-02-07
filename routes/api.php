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

Route::group(['namespace' => 'Crm\Api', 'prefix' => 'crm/enquiries'], function () {
    Route::get('/index', 'EnquiryApiController@index');
    Route::get('/show', 'EnquiryApiController@show');
    Route::patch('/{enquiry}/make/client', 'EnquiryApiController@client');
    Route::patch('/{enquiry}/accept', 'EnquiryApiController@accept');
    Route::patch('/{enquiry}/reject', 'EnquiryApiController@reject');
});
