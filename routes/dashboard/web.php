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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']], function () {
    Route::get('/', 'DashboardController@summery')->name('welcome');
    Route::view('/test', 'dashboard.categories.show');
    Route::get('/home', 'DashboardController@summery')->name('home');
    //product routes
    Route::resource('hotels', 'HotelsController');
    Route::resource('excursions', 'ExcursionsController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('seos', 'SeosController');
    Route::resource('destinations', 'DestinationsController');
    Route::resource('packages', 'PackagesController');
    Route::resource('plans', 'PlansController');
    Route::resource('users', 'UsersController')->except(['show']);
//    /*-------------------------------------------------------------------------------------*/

});


