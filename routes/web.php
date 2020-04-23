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

Route::pattern('alias', '[\da-z-]+');

Auth::routes();

Route::post('form/send-order', 'FormHandlerController@orderCheck')->name('order.check.send');
Route::post('form/send-recall', 'FormHandlerController@recall')->name('recall.send');
Route::get('search', 'SearchController')->name('search');
Route::get('sitemap.xml', 'SitemapController@xml')->name('sitemap.xml');

//cart routes
Route::group(['prefix' => 'cart', 'as' => 'cart.'], static function () {
    Route::get('', 'CartController@index')->name('index');
    Route::post('add/{product}', 'CartController@add')->name('add')->where('product', '[0-9]+');
    Route::post('remove/{product}', 'CartController@remove')->name('remove')->where('product', '[0-9]+');
    Route::post('update/{product}/{quantity}', 'CartController@update')->name('update')->where('product', '[0-9]+')->where(['quantity', '[0-9]+' ]);
    Route::post('order', 'CartOrderController@order')->name('order');
});

Route::group(['middleware' => ['redirector']], static function () {
    Route::get('{alias}', 'CatalogController@show')->name('catalog.show');
    Route::get('/{alias?}/{page?}', 'PageController@show')->name('page.show')->where('page', '[0-9]+');
    Route::get('product/{alias}', 'CatalogProductController@show')->name('catalog_product.show');
});

Route::group(['prefix' => '_root', 'middleware' => 'auth', 'namespace' => 'Admin', 'as' => 'admin.'], static function () {

    Route::get('', 'HomeController@home')->name('home');

    Route::post('upload-ckeditor', 'CkeditorController@upload')->name('upload-ckeditor');

    foreach (glob(app_path('Domain/**/routes.php')) as $item) {
        require $item;
    }
});

//1c export\import
Route::group(['prefix' => 'commerce', 'namespace' => 'Commerce', 'as' => 'commerce.'], static function () {

    Route::get('import', 'CommerceController@import')->name('import');
});
