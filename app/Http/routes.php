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

//Route::match(['get','post'],'teach','teach@index');
Route::match(['get','post'],'ajaxChatRoom','ajaxChatRoom@index');
Route::match(['get','post'],'weather','weather@index');
Route::match(['get','post'],'box2d','box2d@index');
Route::match(['get','post'],'axis3Record','axis3@record');
Route::match(['get','post'],'axis3Video','axis3@video');
Route::match(['get','post'],'axis3Data','axis3@data');



//測式頁面
//Route::match(['get','post'],'test','test@index');
Route::get('frame', function () {
    return view('frame');
});