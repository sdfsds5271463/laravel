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

//Route::match(['get','post'],'/','index@index'); //首頁
Route::match(['get','post'],'/', function () {	//把聊天室當首頁好了...
echo <<<EOT
<meta http-equiv="refresh" content="0; url=ajaxChatRoom">
EOT;
});

Route::match(['get','post'],'ajaxChatRoom','ajaxChatRoom@index');
Route::match(['get','post'],'box2d','box2d@index');
Route::match(['get','post'],'index','index@index');


//測式頁面
Route::match(['get','post'],'test','test@index');
Route::get('frame', function () {
    return view('frame');
});