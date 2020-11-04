<?php

namespace App\Http\Controllers;

use Mail; //untuk dapat menggunakan email 
use App\Mail\TransactionSuccess; //file email yang dibuat

use App\Transaction; //panggil model model ini
use App\TravelPackage;
use App\TransactionDetail;

use Carbon\Carbon; //untuk memformat tanggal yang akan disimpan ke DB

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //untuk mengecek id user

use Midtrans\Config; //untuk memanggil config Midtrans
use Midtrans\Snap; //untuk memanggil snap Midtrans
use Exception;


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
        // return $item;

        $transaction = Transaction::with(['details', 'travel_package'])
            ->findOrFail($item->transactions_id); //$transaction_id ambil dari fild TransactionDetail

        if ($item->is_visa) {
            $transaction->transaction_total -= 190;
            $transaction->additional_visa -= 190;
        }

        $transaction->transaction_total -=
            $transaction->travel_package->price; //harga dari travel packagenya 

        $transaction->save(); //untuk save transaction
        $item->delete(); //untuk menghapus item

        // return $item;
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
        $transaction = Transaction::with(['details', 'travel_package.galleries', 'user'])->findOrfail($id); //tambahkan with agar semua data bisa dipanggil di Mail
        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // Buat array untuk dikirimkan ke midtrans
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => 'MIDTRANS-' . $transaction->id,
                'gross_amount' => (int) $transaction->transaction_total,
            ],
            'costumer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
            ],
            'enabled_payments' => '[gopay]',
            'vtweb' => [],
        ];

        try {
            // Ambil halaman payment Midtrans
            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

            //Redirect ke Halaman Midtrans
            Header('Location: ' . $paymentUrl);
        } catch (Exception $e) { //ubah ke Exception
            echo $e->getMessage();
        }


        // --- FLOW UNTUK TIDAK MENGGUNAKAN MIDTRANS ---
        // return $transaction;

        //kirim email ke user eTicket nya 
        // Mail::to($transaction->user)->send(
        //     new TransactionSuccess($transaction)
        // ); //untuk dikirimkan ke construct di TransactionSuccess

        // return view('pages.success');
    }
}
