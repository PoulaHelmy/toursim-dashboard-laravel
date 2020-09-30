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
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('/', function () {
        return view('dashboard.welcome');
    })->name('welcome');
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    //product routes
    Route::resource('hotels', 'HotelsController');
    Route::resource('excursions', 'ExcursionsController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('seos', 'SeosController');
    Route::resource('destinations', 'DestinationsController');
    Route::resource('packages', 'PackagesController');
//    /*-------------------------------------------------------------------------------------*/
//    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
//        //Welcome Route
//        Route::get('/', 'WelcomeController@index')->name('welcome');
//        Route::get('review/{id}/{res}', 'ArticlesController@review')->name('reviewarticle');
//        //user routes
//        Route::resource('users', 'UsersController')->except(['show']);
//        Route::resource('roles', 'RoleController')->except(['show']);
//    });//end of dashboard routes

});


