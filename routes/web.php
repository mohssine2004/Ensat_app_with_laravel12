<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');
// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/login/google', [AuthController::class, 'loginWithGoogle'])->name('login.google');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// User Dashboard
Route::middleware('auth')->get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.index');
    }
    return view('dashboard');
})->name('dashboard');
// Profile Update
Route::middleware('auth')->post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
// Admin Routes
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::post('/', [AdminController::class, 'store'])->name('store');
    Route::put('/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
});
