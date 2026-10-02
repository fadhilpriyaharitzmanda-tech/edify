<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Halaman utama / landing page
     */
    public function index()
    {
        // Kursus populer bisa diambil dari DB kalau model Course sudah ada
        // Sementara pakai collection kosong agar view tidak error
        $popularCourses = collect();

        return view('user.index', compact('popularCourses'));
    }
}
