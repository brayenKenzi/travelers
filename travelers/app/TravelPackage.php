<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //agar bisa dipakai soft delete nya maka harus di panggil dlu


// untuk membuat model : php artisan make:model TravelPackage
class TravelPackage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'location',
        'about',
        'featured_event',
        'language',
        'foods',
        'departure_date',
        'duration',
        'type',
        'price'
        //field dari table Travel_package
        // agar model bisa dipanggil harusa ditambahkan ke Controller
        // Contoh : TravelPackageController
    ];

    protected $hidden = [];
}
