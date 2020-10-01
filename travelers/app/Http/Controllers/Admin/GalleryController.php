<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request\Admin\GalleryRequest; //untuk validasi
use App\Gallery; //tambahkan Model Gallery agar bisa dipanggil
use Illuminate\Http\Request;
use Illuminate\Support\Str; //panggil library str agar bisa dipakai di slug

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Gallery::with(['travel_package'])->get(); //untuk mengambil relasi dari Model Gallery

        return view('pages.admin.gallery.index', [ //kembalikan view indexnya
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
        return view('pages.admin.gallery.create'); //untuk mengembalikaan view create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->all();
        $data['slug'] =  Str::slug($request->title); //MENGKONFERSI TITLE MENJADI SLUG YANG DAPAT DIBACA OLEH ID 'BENTUKNYA NAMA.../DATA.../'

        Gallery::create($data); //Panggil MODEL gallery dan panggil fungsi create lalu ambil semua data beserta slug.
        return redirect()->route('gallery.index'); //untuk mengembalikan index gallery ke user
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
        $item = Gallery::findOrFail($id); //findOrFail adalah fungsi untuk memunculkan data bila ada & mengembalikan 404 jika tidak ketemu

        return view ('pages.admin.gallery.edit', [ //untuk mengembalikan halaman edit
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
    public function update(GalleryRequest $request, $id) //Panggil validasinya agar field tidak boleh kosong
    {
        $data = $request->all();
        $data['slug'] =  Str::slug($request->title);

        $item = Gallery::findOrFail($id); 

        $item->update($data); //Panggil variable item dan jalankan fungsi update untuk mengubah $data 
        
        return redirect()->route('gallery.index'); //jika sudah selesai di update maka akan dikembalikan ke index gallery
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Gallery::findOrFail($id);
        $item->delete();

        return redirect()->route('gallery.index');
    }
}
