<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Halaman dashboard admin
     */
    public function index()
    {
        // Data statistik — ganti dengan query model sesungguhnya setelah migration dibuat
        $totalUsers    = \App\Models\User::count();
        $totalCourses  = class_exists(\App\Models\Course::class) ? \App\Models\Course::count() : 0;
        $totalOrders   = class_exists(\App\Models\Order::class)  ? \App\Models\Order::count()  : 0;
        $totalRevenue  = 0;
        $recentUsers   = \App\Models\User::latest()->take(5)->get();
        $recentOrders  = collect();

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'totalCourses',
            'totalOrders',
            'totalRevenue',
            'recentUsers',
            'recentOrders'
        ));
    }
}
