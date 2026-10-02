<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Daftar semua transaksi (admin)
     */
    public function index(Request $request)
    {
        // Placeholder — ganti dengan model Order setelah dibuat
        $orders        = collect();
        $totalOrders   = 0;
        $totalRevenue  = 0;
        $pendingOrders = 0;

        return view('admin.orders.index', compact(
            'orders',
            'totalOrders',
            'totalRevenue',
            'pendingOrders'
        ));
    }
}
