<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.home'); //contoh folder pages/home.blade.php
    }
}

// controller untuk menampung function yang bergunan untuk mereturn tampilan 