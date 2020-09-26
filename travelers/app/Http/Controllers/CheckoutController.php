<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// controller untuk menampilkan page Checkout & Success
class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.checkout');
    }

    public function success(Request $request)
    {
        return view('pages.success');
    }
}
