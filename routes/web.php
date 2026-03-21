<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PatientPortalController;
use App\Http\Controllers\PatientAuthController;

Route::get('/appointments/create', [\App\Http\Controllers\AppointmentController::class, 'create'])->name('appointments.create');

/*
|--------------------------------------------------------------------------
| 1. DEFAULT ROUTE
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // Send standard visitors to the patient portal login by default
    return redirect()->route('portal.login');
});


/*
|--------------------------------------------------------------------------
| 2. GUEST ROUTES (Unauthenticated Users Only)
|--------------------------------------------------------------------------
| If you are already logged in and try to visit these, Laravel will
| automatically bounce you to your dashboard.
*/
Route::middleware('guest')->group(function () {

    // --- STAFF / ADMIN LOGIN ---
    // Note: This holds the core 'login' name that Laravel defaults to
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    // --- PATIENT PORTAL LOGIN ---
    Route::prefix('portal')->name('portal.')->group(function () {
        Route::get('/login', [PatientAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [PatientAuthController::class, 'login'])->name('login.post');
        Route::get('/register', [PatientAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [PatientAuthController::class, 'register'])->name('register.store');
    });

});


/*
|--------------------------------------------------------------------------
| 3. AUTHENTICATED ROUTES (Logged In Users Only)
|--------------------------------------------------------------------------
| You MUST be logged in to view anything in this group.
*/
Route::middleware('auth')->group(function () {

    // --- STAFF ADMIN PANEL ---
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{id}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::resource('medical-records', MedicalRecordController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Staff Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    // --- PATIENT PORTAL DASHBOARD ---
    Route::prefix('portal')->name('portal.')->group(function () {
        Route::get('/dashboard', [PatientPortalController::class, 'dashboard'])->name('dashboard');

        // Make sure this matches the method in your PatientPortalController!
        // Based on your previous code, it was 'emergencyRequest'
        Route::post('/emergency', [PatientPortalController::class, 'emergencyRequest'])->name('emergency');

        // Patient Logout
        Route::post('/logout', [PatientAuthController::class, 'logout'])->name('logout');
    });

});
