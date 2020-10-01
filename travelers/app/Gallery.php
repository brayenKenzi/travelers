<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //agar bisa dipakai soft delete nya maka harus di panggil dlu


// untuk membuat model : php artisan make:model TravelPackage
class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'travel_packages_id',
        'image',
        //field dari table Travel_package
        // agar model bisa dipanggil harusa ditambahkan ke Controller
        // Contoh : Gallery 
    ];

    protected $hidden = [];

    // membuat relasi antara travle_package dan gallery
    public function travel_package()
    {
        return $this->belongsTo(TravelPackage::class, 'travle_packages_id', 'id') //belongsTo adalah "Punya nya siapa"
                                                        //Forgein key       Owner ID
    }
}
