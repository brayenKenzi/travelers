<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request\Admin\TravelPackageRequest; //untuk validasi
use App\TravelPackage; //tambahkan Model TravelPackage agar bisa dipanggil
use Illuminate\Http\Request;
use Illuminate\Support\Str; //panggil library str agar bisa dipakai di slug

class TravelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = TravelPackage::all(); //Panggil semua yang ada di TravelPackage

        return view('pages.admin.travel-package.index', [ //kembalikan view indexnya
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.travel-package.create'); //untuk mengembalikaan view create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelPackageRequest $request)
    {
        $data = $request->all();
        $data['slug'] =  Str::slug($request->title); //MENGKONFERSI TITLE MENJADI SLUG YANG DAPAT DIBACA OLEH ID 'BENTUKNYA NAMA.../DATA.../'

        TravelPackage::create($data); //Panggil MODEL travelpackage dan panggil fungsi create lalu ambil semua data beserta slug.
        return redirect()->route('travel-package.index'); //untuk mengembalikan index travel-package ke user
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = TravelPackage::findOrFail($id); //findOrFail adalah fungsi untuk memunculkan data bila ada & mengembalikan 404 jika tidak ketemu

        return view ('pages.admin.travel-package.edit', [ //untuk mengembalikan halaman edit
            'item' => $item //yang isi nya variable item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TravelPackageRequest $request, $id) //Panggil validasinya agar field tidak boleh kosong
    {
        $data = $request->all();
        $data['slug'] =  Str::slug($request->title);

        $item = TravelPackage::findOrFail($id); 

        $item->update($data); //Panggil variable item dan jalankan fungsi update untuk mengubah $data 
        
        return redirect()->route('travel-package.index'); //jika sudah selesai di update maka akan dikembalikan ke index travel-package
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
