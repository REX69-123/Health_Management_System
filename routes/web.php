<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PatientPortalController;
use App\Http\Controllers\PatientAuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| 1. DEFAULT ROUTE
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('portal.login');
});

// Admin Management Routes
Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create'); // New!
Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
Route::put('/admins/{admin}', [AdminController::class, 'update'])->name('admins.update');
Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');
use App\Http\Controllers\ConsultationController;

// Add this inside your authenticated group:
Route::resource('consultations', ConsultationController::class);

/*
|--------------------------------------------------------------------------
| 2. GUEST ROUTES (Unauthenticated Users Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // --- STAFF/ADMIN LOGIN ---
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');

    // --- INITIAL ADMIN REGISTRATION ---
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    // --- PATIENT PORTAL LOGIN ---
    Route::prefix('portal')->name('portal.')->group(function () {
        Route::get('/login', [PatientAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [PatientAuthController::class, 'login'])->name('login.post');
    });
});

/*
|--------------------------------------------------------------------------
| 3. ADMIN & STAFF ROUTES (Protected by 'web' guard)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Staff Management
    Route::get('/staff/add', [AuthController::class, 'showRegisterForm'])->name('admin.staff.create');
    Route::post('/staff/add', [AuthController::class, 'register'])->name('admin.staff.store');

    // Patient Management
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');

    Route::get('/patients/{id}/account', [PatientController::class, 'createAccount'])->name('patients.account.create');
    Route::post('/patients/{id}/account', [PatientController::class, 'storeAccount'])->name('patients.account.store');

    Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{id}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');

    // Resources
    Route::resource('appointments', AppointmentController::class);
    Route::resource('medical-records', MedicalRecordController::class);

    // Profile & Logout
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| 4. PATIENT PORTAL SECURE AREA (Protected by 'patient' guard)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:patient')->prefix('portal')->name('portal.')->group(function () {
    Route::get('/dashboard', [PatientPortalController::class, 'dashboard'])->name('dashboard');
    Route::post('/emergency', [PatientPortalController::class, 'emergencyRequest'])->name('emergency');
    Route::post('/logout', [PatientAuthController::class, 'logout'])->name('logout');
});
