<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('pages.home'); //balikan lagi ke pages.home
    }
}
