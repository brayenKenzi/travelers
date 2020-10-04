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

Route::get('/detail/{slug}', 'DetailController@index') //slug untuk pengganti ID
->name('detail');

Route::post('/checkout/{id}', 'CheckoutController@process') //mengunakan parameter ID dan memanggil methon process
    ->name('checkout_process') //untuk merubah name 
    ->middleware(['auth', 'verified']); //untuk verifikasi apakah sudah login atau belum 'SATPAM'

Route::get('/checkout/{id}', 'CheckoutController@index')
    ->name('checkout')
    ->middleware(['auth', 'verified']);

Route::post('/checkout/create/{detail_id}', 'CheckoutController@create')
    ->name('checkout-create')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/remove/{detail_id}', 'CheckoutController@remove')
    ->name('checkout-remove')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/confirm/{id}', 'CheckoutController@success')
    ->name('checkout-success')
    ->middleware(['auth', 'verified']);




Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin']) //auth dan admin di ambil dari kernel.php
    ->group(function () {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');

        
        Route::resource('travel-package', 'TravelPackageController');//agar bisa dipanggil link travle-packagenya

        Route::resource('gallery', 'GalleryController'); //agar bisa dipanggil link gallery

        Route::resource('transaction', 'TransactionController');

    });

Auth::routes(['verify' => true]); //verifikasi masuk

// HAPUS AGAR TIDAK BENTROK DENGAN DI ATAS Route::get('/home', 'HomeController@index')->name('home');
