<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes; //agar bisa dipakai soft delete nya maka harus di panggil dlu

// | LANGKAH-LANGKAH CRUD DI LARAVEL,
// - BUAT MODEL
// - BUAT REQUEST
// - BUAT CONTROLLER untuk crud
// - perbaiki halaman webnya

// untuk membuat model : php artisan make:model TravelPackage
class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'travel_packages_id',
        'image'
        //field dari table Galleries
        // agar model bisa dipanggil harusa ditambahkan ke Controller
        // Contoh : Gallery 
    ];

    protected $hidden = [];

    // membuat relasi antara travel_package dan gallery agar bisa terkoneksi 2 table
    public function travel_package()
    {
        return $this->belongsTo(TravelPackage::class, 'travel_packages_id', 'id'); //belongsTo adalah "Punya nya siapa"
        //Forgein key       Owner ID
    }
}
