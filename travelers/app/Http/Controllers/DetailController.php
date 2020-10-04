<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TravelPackage;

class DetailController extends Controller
{
    public function index(Request $request, $slug)
    {
        $item = TravelPackage::with(['galleries']) //$item isinya adalah model TravelPackage dengan relasi Galleries
                    ->where('slug', $slug) //slug adalah $slug agar bisa dipakai diluar
                    ->firstOrFail(); //munculkan yang pertama kalau tidak ada keluarkan error
        return view('pages.detail',[
            'item' => $item //item yang berada disini adalah $item yang bisa dipakai diluar.
        ]);
    }
}
