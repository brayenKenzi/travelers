<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TravelPackage; //panggil model travle package

class HomeController extends Controller
{

    //HAPUS FUNCTION CONSTRUCT YG DI TIMPA AUTH
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = TravelPackage::with('galleries')->get(); //Panggil model TravelPackage berserta Relasi Table Galleries untuk gambarnya dan jalankan method get().
        return view('pages.home', [
            'items' => $items //items disini adalah $items yang ada diatasnya
        ]); //balikan lagi ke pages.home
    }
}
