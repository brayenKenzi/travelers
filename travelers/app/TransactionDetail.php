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
class TransactionDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'transaction_id', 
        'username',
        'nationality',
        'is_visa',
        'doe_passport'
        //field dari table Galleries
        // agar model bisa dipanggil harusa ditambahkan ke Controller
        // Contoh : Gallery 
    ];

    protected $hidden = [];

    //untuk relasi ke 'transaction'
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    } //UNTUK MENYAMBUNGKAN KE TABLE transaction_id DENGAN KEY | ID

}
