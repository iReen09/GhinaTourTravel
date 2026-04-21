<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Pesanan;

class DashboardController extends Controller
{
    public function index()
    {
        $revenue = Pesanan::where('status', 'selesai')->sum('total_harga');
        $orders = Pesanan::latest()->take(10)->get();
        $totalPaket = Paket::count();
        return view('admin.index', compact('revenue', 'orders', 'totalPaket'));
    }
}
