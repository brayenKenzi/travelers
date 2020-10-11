<?php

namespace App\Http\Controllers;

use App\Transaction; //panggil model model ini
use App\TravelPackage;
use App\TransactionDetail;

use Carbon\Carbon; //untuk memformat tanggal yang akan disimpan ke DB

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //untuk mengecek id user


// controller untuk menampilkan page Checkout & Success
class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Transaction::with(['details', 'travel_package', 'user'])->findOrFail($id);
        return view('pages.checkout', [
            'item' => $item
        ]);
    }



    public function process(Request $request, $id) //FUNGSINYA UNTUK MEMBUAT DATA ATAU MEMASUKAN DATA KE TABLE TRANSAKSI
    {
        $travel_package = TravelPackage::findOrFail($id); //ambil data TravelPackage sesuai ID nya kalau tidak ada kembalikan 404

        $transaction = Transaction::create([
            'travel_package_id' => $id,
            'users_id' => Auth::user()->id, //ID USER yang sedang login
            'additional_visa' => 0,
            'transaction_total' => $travel_package->price, //harga dari travel tersebut
            'transaction_status' => 'IN_CART'
        ]);

        TransactionDetail::create([ //fungsi untuk manambahkan orang dari luar agar bisa dicheckout ID tersebut
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
            'nationality' => 'ID',
            'is_visa' => false,
            'doe_passport' => Carbon::now()->addYears(5) //untuk memunculkan waktu sekarang dan tambah tahun
        ]);

        return redirect()->route('checkout', $transaction->id);
    }



    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findOrfail($detail_id);

        $transaction = Transaction::with(['details', 'travel_package'])
            ->findOrFail($item->transaction_id);

        if ($item->is_visa) {
            $transaction->transaction_total -= 190;
            $transaction->additional_visa -= 190;
        }

        $transaction->transaction_total -=
            $transaction->travel_package->price; //harga dari travel packagenya 

        $transaction->save(); //untuk save transaction
        $item->delete(); //untuk menghapus item

        return redirect()->route('checkout', $item->transactions_id);
    }



    public function create(Request $request, $id)
    {
        // untuk Validasi
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'is_visa' => 'required|boolean',
            'doe_passport' => 'required'
        ]);

        // mengatur data untuk dimasukan ke Transaction_detail -> transactions_id
        $data = $request->all();
        $data['transactions_id'] = $id; //isi dari $data sebelumnya di tambahkan array baru berisi transactions_id

        // untuk Insert data nya
        TransactionDetail::create($data); //yaitu isi $data diatas

        // ambil data Transaction
        $transaction = Transaction::with(['travel_package'])->find($id);

        // untuk update total dan visa nya harus berapa
        if ($request->is_visa) {
            $transaction->transaction_total += 190;
            $transaction->additional_visa += 190;
        }

        $transaction->transaction_total +=
            $transaction->travel_package->price; //harga dari travel packagenya 

        $transaction->save(); //untuk save transaction

        return redirect()->route('checkout', $id);
    }



    public function success(Request $request, $id)
    {
        $transaction = Transaction::findOrfail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        return view('pages.success');
    }
}
