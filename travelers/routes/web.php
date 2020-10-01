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


// Route untuk memanggil controller agar bisa mereturn tampilan yang dibuat
Route::get('/', 'HomeController@index')
->name('home');

Route::get('/detail', 'DetailController@index')
->name('detail');

Route::get('/checkout', 'CheckoutController@index')
->name('checkout');

Route::get('/success', 'CheckoutController@success')
->name('success');


Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin']) //auth dan admin di ambil dari kernel.php
    ->group(function () {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');

        
        Route::resource('travel-package', 'TravelPackageController');//agar bisa dipanggil link travle-packagenya

        Route::resource('gallery', 'GalleryController'); //agar bisa dipanggil link gallery

    });

Auth::routes(['verify' => true]); //verifikasi masuk

// HAPUS AGAR TIDAK BENTROK DENGAN DI ATAS Route::get('/home', 'HomeController@index')->name('home');
