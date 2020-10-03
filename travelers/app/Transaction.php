<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes; //agar bisa dipakai soft delete nya maka harus di panggil dlu

// | LANGKAH-LANGKAH CRUD DI LARAVEL,
// - BUAT MODEL
// - BUAT REQUEST
// - BUAT CONTROLLER untuk crud
// - perbaiki halaman webnya

// untuk membuat model : php artisan make:model Transaction
class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'travel_package_id', 
        'user_id',
        'additional_visa',
        'transaction_total',
        'transaction_status'
        //field dari table Galleries
        // agar model bisa dipanggil harusa ditambahkan ke Controller
        // Contoh : Gallery 
    ];

    protected $hidden = [];

    // membuat relasi antara travel_package dan gallery agar bisa terkoneksi 2 table
    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id', 'id');
    } //HASMANY untuk membuat penyambungan ke table berikut

    public function travel_package()
    {
        return $this->belongsTo(TravelPackage::class, 'travel_package_id', 'id');
    } //UNTUK MENYAMBUNGKAN KE TABLE travel_package_id DENGAN KEY | ID

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    } //UNTUK MENYAMBUNGKAN KE TABLE users_id DENGAN KEY | ID
}
