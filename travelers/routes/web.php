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

Route::post('/checkout/{id}', 'CheckoutController@process') //halaman checkout dengan tambahan parameter ID dan untuk menjalankan Proses data dari checkout
    ->name('checkout_process') //untuk merubah name 
    ->middleware(['auth', 'verified']); //untuk verifikasi apakah sudah login atau belum 'SATPAM'

Route::get('/checkout/{id}', 'CheckoutController@index')
    ->name('checkout')
    ->middleware(['auth', 'verified']);

Route::post('/checkout/create/{detail_id}', 'CheckoutController@create') //untuk menambahkan user yang ini checkout selain kita
    ->name('checkout-create')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/remove/{detail_id}', 'CheckoutController@remove') //untuk menghapus user
    ->name('checkout-remove')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/confirm/{id}', 'CheckoutController@success') //jika user sudah yakin dan sudah konfirmasi maka statusnya akan menjadi Sukses
    ->name('checkout-success')
    ->middleware(['auth', 'verified']);




Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin']) //auth dan admin di ambil dari kernel.php
    ->group(function () {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');

        
        Route::resource('travel-package', 'TravelPackageController');//agar bisa dipanggil link travle-packagenya

        // Route::get('')

        Route::resource('gallery', 'GalleryController'); //agar bisa dipanggil link gallery

        Route::resource('transaction', 'TransactionController');

    });

Auth::routes(['verify' => true]); //verifikasi masuk

// HAPUS AGAR TIDAK BENTROK DENGAN DI ATAS Route::get('/home', 'HomeController@index')->name('home');
