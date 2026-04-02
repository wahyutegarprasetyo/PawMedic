<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GejalaController;

Route::get('/gejala', [GejalaController::class, 'index'])->name('gejala');

Route::get('/', function () {
    return view('landing');
});

Route::get('/biodata', function () {
    return view('biodata');
})->name('biodata');

Route::get('/loading', function () {
    return view('loading');
})->name('loading');

Route::post('/diagnosis/proses', [DiagnosisController::class, 'prosesDiagnosis'])->name('diagnosis.proses');

Route::get('/hasil-diagnosis', function () {
    return view('hasil-diagnosis');
})->name('hasil-diagnosis');

Route::get('/ulasan', function () {
    return view('ulasan');
})->name('ulasan');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// Admin Routes
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
