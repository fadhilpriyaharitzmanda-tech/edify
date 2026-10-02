<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Daftar semua kursus (halaman user)
     */
    public function index(Request $request)
    {
        // Placeholder — ganti dengan model Course setelah dibuat
        $courses = collect();

        return view('user.courses.index', compact('courses'));
    }

    /**
     * Detail kursus
     */
    public function show($course)
    {
        // Placeholder
        // $course = Course::with(['instructor', 'modules.lessons'])->findOrFail($course);
        // $isEnrolled = auth()->check() && auth()->user()->enrollments()->where('course_id', $course->id)->exists();

        return view('user.courses.show', [
            'course'     => (object)[
                'title'             => 'Contoh Kursus',
                'description'       => 'Deskripsi kursus akan tampil setelah model Course tersedia.',
                'category'          => 'Teknologi',
                'price'             => 0,
                'duration'          => '10',
                'level'             => 'Pemula',
                'enrollments_count' => 0,
                'instructor'        => (object)['name' => 'Instruktur'],
                'outcomes'          => [],
                'modules'           => [],
            ],
            'isEnrolled' => false,
        ]);
    }

    /**
     * Daftar kursus (enroll)
     */
    public function enroll(Request $request, $course)
    {
        // TODO: implement enrollment logic
        return back()->with('success', 'Berhasil mendaftar kursus!');
    }
}
