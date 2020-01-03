<?php

use Illuminate\Http\Request;

Route::get('info-master',  'MasterClassController@getInfo');
Route::post('info-master',  'MasterClassController@putInfo');
Route::get('photo-master',  'MasterClassController@getPhoto');

Route::get('users-messages',  'UsersMessagesController@getMessages');
Route::post('users-messages',  'UsersMessagesController@putMessage');

Route::get('master-request',  'MasterClassController@getRequest');
Route::post('master-request',  'MasterClassController@postRequest');
Route::delete('master-request/{id}',  'MasterClassController@deleteRequest')->where(['id' => '^[0-9]+']);

Route::post('period', 'PeriodController@updatePeriod');
Route::get('period', 'PeriodController@getPeriod');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
