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


Route::prefix("admin")->group(function (){//后台
    Route::prefix("brand")->group(function (){
        Route::get("create","Admin\BrandController@create")->name("brand.create");
        Route::any("uploads","Admin\BrandController@uploads");
        Route::any("store","Admin\BrandController@store");
        Route::any("index","Admin\BrandController@index")->name("brand.index");
        Route::any("change","Admin\BrandController@change");
        Route::any("edit/{id}","Admin\BrandController@edit");
        Route::any("update","Admin\BrandController@update");
        Route::any("destroy","Admin\BrandController@destroy");
        Route::any("destroys","Admin\BrandController@destroys");//批量删除

    });
});
