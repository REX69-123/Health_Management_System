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
use App\Http\Controllers\ConsultationController;

Route::get('/', function () {
    return redirect()->route('portal.login');
});

// --- GUEST ROUTES ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::prefix('portal')->name('portal.')->group(function () {
        Route::get('/login', [PatientAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [PatientAuthController::class, 'login'])->name('login.post');
    });
});

// --- AUTHENTICATED STAFF/ADMIN ROUTES ---
Route::middleware('auth')->group(function () {
    Route::resource('medical-records', MedicalRecordController::class);
    Route::resource('consultations', ConsultationController::class);
    
    // Admins
    Route::resource('admins', AdminController::class);

    // Patients (Using resource for cleaner definition)
    Route::resource('patients', PatientController::class);
    Route::get('/patients/{id}/account', [PatientController::class, 'createAccount'])->name('patients.account.create');
    Route::post('/patients/{id}/account', [PatientController::class, 'storeAccount'])->name('patients.account.store');

    // Medical Records & Consultations
    Route::resource('medical-records', MedicalRecordController::class);
    Route::resource('consultations', ConsultationController::class);

    // Appointments
    Route::resource('appointments', AppointmentController::class);

    // Profile & Staff
    Route::get('/staff/add', [AuthController::class, 'showRegisterForm'])->name('admin.staff.create');
    Route::post('/staff/add', [AuthController::class, 'register'])->name('admin.staff.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// --- PATIENT PORTAL ---
Route::middleware('auth:patient')->prefix('portal')->name('portal.')->group(function () {
    Route::get('/dashboard', [PatientPortalController::class, 'dashboard'])->name('dashboard');
    Route::post('/emergency', [PatientPortalController::class, 'emergencyRequest'])->name('emergency');
    Route::post('/logout', [PatientAuthController::class, 'logout'])->name('logout');
});
