<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::match(['get','post'],'/','index@index'); //首頁
Route::match(['get','post'],'ajaxChatRoom','ajaxChatRoom@index');

Route::get('frame', function () {
    return view('frame');
});