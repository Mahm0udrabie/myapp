<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SocialController;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Route::get('/landing', function () {
    return view('landing');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@callback');

Route::get('fillable', 'CloudController@getOffers');

    Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        ], function() {
        Route::group(['prefix' => 'offers'], function() {

    Route::get('create', 'CloudController@create');

    Route::post('store', 'CloudController@store')->name('offers.store');

    });
});
