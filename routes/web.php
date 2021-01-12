<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Auth;
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
define("PAGINATION_COUNT", 5);
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
Route::group([
    'prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::group(['prefix' => 'offers'], function () {
        Route::get('create', 'CloudController@create')->name('offers.create');
        Route::get('/{id}/edit', 'CloudController@edit')->name('offers.edit');
        Route::post('store', 'CloudController@store')->name('offers.store');
        Route::put('/{id}/update', 'CloudController@update')->name('offers.update');
        Route::get('all', 'CloudController@getAllOffers')->name('offers.all');
        Route::get('paginations', 'CloudController@getAllOffers')->name('offers.paginations');
        Route::get('/{id}/delete', 'CloudController@delete')->name('offers.delete');
        Route::get('get-all-inactive-offers', "CloudController@get_inactive");
    });
    Route::get('youtube', 'CloudController@getVideo');
});
############## Start Ajax Routes ##############
Route::group(["prefix" => "ajax-offers"], function () {
    Route::get('create', 'AjaxController@create')->name('ajax.offers.create');
    Route::post('store', 'AjaxController@store')->name('ajax.offers.store');
    Route::get('all', 'AjaxController@all')->name('ajax.offers.all');
    Route::get('{id}/edit', 'AjaxController@edit')->name('ajax.offers.edit');
    Route::post('/{id}/update', 'AjaxController@update')->name('ajax.offers.update');
    Route::post('delete', 'AjaxController@delete')->name('ajax.offers.delete');
});
############## End   Ajax Routes ##############

############ Start Authentications and Guards  ###########

Route::group(['middleware' => 'CheckAge', 'namespace' => "Auth"], function () {
    Route::get('adults', 'CustomAuthController@adult')->name("adult");
});
Route::get('site', 'Auth\CustomAuthController@site')->middleware('auth:web')->name('site');
Route::get('admin', 'Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');
Route::get('admin/login', 'Auth\CustomAuthController@adminLogin')->name('admin.login');
Route::post('admin/login', 'Auth\CustomAuthController@CheckAdminLogin')->name('save.admin.login');
############ End Authentications and Guards  ###########


############ start relations routes ##########

######### ONE TO ONE RELATION ###########

############# Start ##############
Route::get('has-one', 'Relations\RelationsController@hasOneRelation');
Route::get('has-one-reverse', 'Relations\RelationsController@hasOneRelationReverse');
Route::get('get-user-has-phone', 'Relations\RelationsController@getUserHasPhone');
Route::get('get-user-has-not-phone', 'Relations\RelationsController@getUserNotHasPhone');
Route::get('get-user-has-phone-with-condition', 'Relations\RelationsController@getUserHasPhoneWithCondition');
############# End ##############

########## ONE TO MANY RELATION ###############

############# Start ##############
Route::get('hospital-has-many', "Relations\RelationsController@getHospitalDoctors");
Route::get('hospitals/', 'Relations\RelationsController@hospitals')->name('hospitals.all');
Route::get('doctors/{hospital_id}', "Relations\RelationsController@doctors")->name('hospital.doctors');
Route::get('hospitals/{hospital_id}', "Relations\RelationsController@deleteHospital")->name('hospital.delete');
Route::get('hospital-has-doctor', "Relations\RelationsController@hospitalsHasDoctors");
Route::get('hospital-has-doctors-male', "Relations\RelationsController@hospitalsHasOnlyMaleDoctors");
Route::get('hospital-does-not-have-doctor', "Relations\RelationsController@hospitalsDoesNotHaveDoctors");
Route::get('doctor/services', "Relations\RelationsController@getDoctorServices");
Route::get('service/doctors', "Relations\RelationsController@getServicesDoctors");
Route::get('doctor/services/{doctor_id}', "Relations\RelationsController@getDoctorServicesById")->name('doctors.services');
Route::post('saveServicesToDoctors', "Relations\RelationsController@saveServicesToDoctors")->name('save.doctors.services');
############# End ##############




################ has one through ##########
Route::get('has-one-through', 'Relations\RelationsController@getPateintDoctor');
Route::get('has-many-through', 'Relations\RelationsController@getCountryDoctor');
##########################################
############ End relations routes ##########

########## Start accessors and moutators ##########

Route::get("accessors", "CloudController@getDoctors");

########## End accessors and moutators ##########

########## Start collection  ##########

Route::get("collection", "CollectToutrial@index");

Route::get("getCollection", "CollectToutrial@complex");

Route::get("getCollectionWithFilter", "CollectToutrial@complexFilter");

Route::get("transform", "CollectToutrial@complexTransform");



########## End collection ##########