<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseController   as AdminCourseController;
use App\Http\Controllers\Admin\UserController     as AdminUserController;
use App\Http\Controllers\Admin\OrderController    as AdminOrderController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\User\CourseController    as UserCourseController;
use App\Http\Controllers\PlaygroundController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Python Code Playground & Sandbox
Route::get('/playground', [PlaygroundController::class, 'index'])->name('playground.index');
Route::post('/playground/run', [PlaygroundController::class, 'run'])->name('playground.run');


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    // Register
    Route::get('/register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

    // Lupa password
    Route::get('/forgot-password',  [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Reset password
    Route::get('/reset-password/{token}',  [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password',         [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Logout (hanya untuk yang sudah login)
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Verifikasi email
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [VerifyEmailController::class, 'show'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [VerifyEmailController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});

/*
|--------------------------------------------------------------------------
| User / Public Kursus Routes
|--------------------------------------------------------------------------
*/

// Halaman kursus (bisa diakses tanpa login)
Route::prefix('courses')->name('user.courses.')->group(function () {
    Route::get('/',           [UserCourseController::class, 'index'])->name('index');
    Route::get('/{course}',   [UserCourseController::class, 'show'])->name('show');

    // Enroll butuh login
    Route::post('/{course}/enroll', [UserCourseController::class, 'enroll'])
        ->middleware('auth')
        ->name('enroll');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Kursus (resource)
    Route::resource('courses', AdminCourseController::class)->names([
        'index'   => 'courses.index',
        'create'  => 'courses.create',
        'store'   => 'courses.store',
        'show'    => 'courses.show',
        'edit'    => 'courses.edit',
        'update'  => 'courses.update',
        'destroy' => 'courses.destroy',
    ]);

    // Manajemen Pengguna (resource)
    Route::resource('users', AdminUserController::class)->names([
        'index'   => 'users.index',
        'create'  => 'users.create',
        'store'   => 'users.store',
        'show'    => 'users.show',
        'edit'    => 'users.edit',
        'update'  => 'users.update',
        'destroy' => 'users.destroy',
    ]);

    // Transaksi
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');

    // Pengaturan Profil Admin
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('profile', [AdminSettingsController::class, 'profile'])->name('profile');
        Route::patch('profile', [AdminSettingsController::class, 'updateProfile'])->name('profile.update');
        Route::put('password', [AdminSettingsController::class, 'updatePassword'])->name('password.update');
    });

    // Hapus akun (dari admin settings — danger zone)
    Route::delete('profile', [AdminSettingsController::class, 'destroyAccount'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| User (Auth Required) Routes — Dashboard, Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // User Dashboard
    Route::get('/dashboard', function () {
        return view('user.dashboard.index');
    })->name('user.dashboard');

    // User Profile
    Route::get('/profile',          function () { return view('user.profile.index'); })->name('profile.show');
    Route::patch('/profile',        [AdminSettingsController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AdminSettingsController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile',       [AdminSettingsController::class, 'destroyAccount'])->name('profile.destroy');
});
