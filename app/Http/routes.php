<?php

Route::get('/', function () { return view('index'); });
Route::get('/index.php', function () { return view('index'); });
Route::get('/keyboard', function () { return view('keyboardLayout'); });
Route::get('/res', "ResultController@ShowResult");
Route::get('/GreekChart', "ResultController@GreekChart");
//Route::get('/LatinChart', "ResultController@LatinChart");

Route::group(['middleware' => ['web']], function () {

});
