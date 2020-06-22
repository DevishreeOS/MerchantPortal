<?php

use Illuminate\Support\Facades\Route;

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
Route::get('select','UserController@index');
Route::get("name/{name}",'UserController@display');
Route::get('list','UserController@ListOfCategory');
Route::get('getsubCategory','UserController@getSubCategory');
Route::get('getproductImage/{id}','UserController@getProductImage');
Route::get('getImage','UserController@getImage');
Route::get('getCount','UserController@getCount');
Route::get('getImg','UserController@getImg');
Route::get('getAmount','UserController@getAmount');
Route::get('getFilterImage/{size}','UserController@getFilterImage');
Route::get('check/{size}/{brand}/{amount}/{color}','UserController@check');
Route::get('checkAmount','UserController@checkAmount');
Route::get('modal','UserController@modal');
Route::get('getColor','UserController@getColor');
Route::get('checkcolor/{color}','UserController@checkcolor');
Route::get('clientdetails','ClientDetailsController@index');
Route::get('clientRegister','ClientDetailsController@create');
Route::post('saveClientDetails','ClientDetailsController@save');
Route::get('showClientDetails/{clientID}','ClientDetailsController@show');
Route::post('updateClientDetails/{clientID}','ClientDetailsController@update');
Route::get('editClientDetails/{clientID}','ClientDetailsController@edit');
Route::get('deleteClientDetails/{clientID}','ClientDetailsController@destroy');
Route::get('productdetails','ProductDetailsController@index');
Route::get('product/{productID}/{subCategoryID}','ProductDetailsController@showProductDetails');
Route::get('master','ProductDetailsController@master');
Route::get('breadcrumbs','ProductDetailsController@breadcrumbs');
Route::get('demoshow','ProductDetailsController@index');
Route::post('demosave','ProductDetailsController@demosave');
Route::get('showdemo','ProductDetailsController@show');
Route::get('getdemo','UserController@getdemo');
Route::get('demolist','UserController@demolist');
Route::get('getsubCategoryName','UserController@getSubCategoryName');
Route::get('getCategoryName','UserController@getCategoryName');
Route::get('breadcrumbcategory/{categoryID}','UserController@breadcrumbcategory');
Route::get('breadcrumbsubcategory/{subcategoryID}','UserController@breadcrumbsubcategory');
Route::get('starrating','ProductDetailsController@starrating');