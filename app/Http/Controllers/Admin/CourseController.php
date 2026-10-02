<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Daftar semua kursus (admin)
     */
    public function index(Request $request)
    {
        // Placeholder — ganti dengan query model Course setelah migration dibuat
        $courses           = collect();
        $totalCourses      = 0;
        $publishedCourses  = 0;
        $draftCourses      = 0;
        $totalEnrollments  = 0;

        return view('admin.courses.index', compact(
            'courses',
            'totalCourses',
            'publishedCourses',
            'draftCourses',
            'totalEnrollments'
        ));
    }

    /**
     * Form buat kursus baru
     */
    public function create()
    {
        // return view('admin.courses.create');
        return redirect()->route('admin.courses.index')
            ->with('info', 'Fitur buat kursus belum tersedia.');
    }

    /**
     * Simpan kursus baru
     */
    public function store(Request $request)
    {
        // TODO: implement after Course model & migration created
        return redirect()->route('admin.courses.index');
    }

    /**
     * Detail kursus
     */
    public function show($course)
    {
        // TODO: implement after Course model created
        return redirect()->route('admin.courses.index');
    }

    /**
     * Form edit kursus
     */
    public function edit($course)
    {
        // TODO: implement after Course model created
        return redirect()->route('admin.courses.index');
    }

    /**
     * Update kursus
     */
    public function update(Request $request, $course)
    {
        return redirect()->route('admin.courses.index');
    }

    /**
     * Hapus kursus
     */
    public function destroy($course)
    {
        return redirect()->route('admin.courses.index');
    }
}
