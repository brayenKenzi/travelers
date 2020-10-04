<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TravelPackage;
use App\Transaction;

class DashboardController extends Controller
{
    public function index(Request $requet)
    {
        return view('pages.admin.dashboard',[
            'travel_package' => TravelPackage::count(), //untuk membuat variable $travel_package yang isi nya Total dari TravelPackage
            'transaction' => Transaction::count(), //variable $transaction nanti nya akan dipanggil di dashboard.blade
            'transaction_pending' => Transaction::where('transaction_status', 'PENDING')->count(), //variable $transaction_pending nanti nya akan dipanggil di dashboard.blade
            'transaction_success' => Transaction::where('transaction_status', 'SUCCESS')->count(), //variable $transaction_success nanti nya akan dipanggil di dashboard.blade
        
        ]);
    }
}
