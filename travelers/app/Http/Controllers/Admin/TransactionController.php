<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request\Admin\GalleryRequest;
use App\Http\Request\Admin\TransactionRequest; //untuk validasi
use App\Transaction; //tambahkan Model Transaction agar bisa dipanggil
use App\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str; //panggil library str agar bisa dipakai di slug


// agar lebih mudah silahklan COPAS dan gunakan FIND and Replace
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Transaction::with([
            'details', 'travel_package', 'user'
        ])->get(); //method WITH untuk memanggil relasi relasi yang sudah dibuat di MODEL dan ambil dengan methor get()

        return view('pages.admin.transaction.index', [ //kembalikan view indexnya
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
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->all();
        $data['slug'] =  Str::slug($request->title); //MENGKONFERSI TITLE MENJADI SLUG YANG DAPAT DIBACA OLEH ID 'BENTUKNYA NAMA.../DATA.../'

        Transaction::create($data); //Panggil MODEL transaction dan panggil fungsi create lalu ambil semua data beserta slug.
        return redirect()->route('transaction.index'); //untuk mengembalikan index transaction ke user
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Transaction::with([
            'details', 'travel_package', 'user'
        ])->findOrFail($id); //findOrFail adalah fungsi untuk memunculkan data bila ada & mengembalikan 404 jika tidak ketemu

        return view ('pages.admin.transaction.detail', [ //untuk mengembalikan halaman detail
            'item' => $item //yang isi nya variable item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Transaction::findOrFail($id); //findOrFail adalah fungsi untuk memunculkan data bila ada & mengembalikan 404 jika tidak ketemu

        return view ('pages.admin.transaction.edit', [ //untuk mengembalikan halaman edit
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
    public function update(TransactionRequest $request, $id) //Panggil validasinya agar field tidak boleh kosong
    {
        $data = $request->all();
        $data['slug'] =  Str::slug($request->title);

        $item = Transaction::findOrFail($id); 

        $item->update($data); //Panggil variable item dan jalankan fungsi update untuk mengubah $data 
        
        return redirect()->route('transaction.index'); //jika sudah selesai di update maka akan dikembalikan ke index transaction
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();

        return redirect()->route('transaction.index');
    }

    // UNTUK DELETE TIDAK PERLU DIUBAH DARI SEBELUMNYA
}
