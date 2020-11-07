<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\TransactionSuccess; //panggil model Mail karena disini akan pakai dikirimkan Mail ketika transaksi Sukses
use App\Transaction;
use Illuminate\Support\Facades\Mail; //untuk menggunakan perintah2 Mail
use Midtrans\Config; //untuk bisa menggunakan config Midtrans
use Midtrans\Notification; //untuk bisa menggunakan Notifikasi Midtrans


//Controller untuk MIDTRANS
//cara buat *php artisan make:controller MidtransController
class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        //set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        //buat Instance midtrans Notifkasi
        $notification = new Notification();

        // Pecah order ID agar bisa diterima oleh database
        // sebelum di Explode contoh | Travelers-15
        // sesudah di Explode jadinya | [Travelers-], [15]. jadi ambil array 1 untuk dipakai ke order ID
        $order = explode('-', $notification->order_id);

        //Assign ke Variable untuk memudahkan config
        $status = $notification->transaction_status; //transaksiStatus adlah bawaan dari Midtrans / "field di database
        $type   = $notification->payment_type; //bawaan dari Midtrans
        $fraud  = $notification->fraud_status;
        $order_id   = $order[1];

        //Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        //Handle notifikasi status Midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->transaction_status = 'CHALLENGE'; //mengecek apakah pembayarannya benar? kalau challange maka status nya challnge
                } else {
                    $transaction->transaction_status = 'SUCCESS'; //kalau benar maka statusnya Success
                }
            }
        } else if ($status == 'settlement') { //settlement = sukses terbayar
            $transaction->transaction_status = 'SUCCESS';
        } else if ($status == 'pending') { //pending = PENDING
            $transaction->transaction_status = 'PENDING';
        } else if ($status == 'deny') { //deny = FAILED
            $transaction->transaction_status = 'FAILED';
        } else if ($status == 'expire') { //expire = EXPIRED
            $transaction->transaction_status = 'EXPIRED';
        } else if ($status == 'cancel') { //CANCEL = failed
            $transaction->transaction_status = 'FAILED';
        }

        //Simpan transaksi
        $transaction->save();

        //kirimkan Email
        if ($transaction) {
            if ($status == 'capture' && $fraud == 'accept') { //Kalau status nya accept maka kirimkan email
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction)
                );
            } else if ($status == 'settlement') { //Kalau status nya settlement maka kirimkan email
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction)
                );
            } else if ($status == 'success') { //Kalau status nya success maka kirimkan email
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction)
                );
            } else if ($status == 'capture' && $fraud == 'challenge') //Kalau status nya capture && fraud nya challenge kembalikan respon json dengan meta sebagai berikut. *response adalah bawaan laravel.
            {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Challege'
                    ]
                ]);
            } else {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment not settlement'
                    ]
                ]);
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans notification success'
                ]
            ]);
        }
    }



    public function  finishRedirect(Request $request)
    {
        return view('pages.success');
    }

    public function unfinishRedirect(Request $request)
    {
        return view('pages.unfinish');
    }

    public function failedRedirect(Request $request)
    {
        return view('pages.failed');
    }
}
