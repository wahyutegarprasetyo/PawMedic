<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\UlasanController;
use App\Models\Ulasan;

Route::get('/admin/sort-diagnosis', [AdminController::class, 'sortDiagnosis']);
Route::get('/admin/export-diagnosis', [AdminController::class, 'exportDiagnosisExcel'])
    ->name('admin.export.diagnosis')
    ->middleware('auth');
Route::get('/admin/disease-settings', [AdminController::class, 'diseaseSettings'])
    ->name('admin.disease.settings')
    ->middleware('auth');
Route::post('/admin/disease-settings', [AdminController::class, 'saveDiseaseSettings'])
    ->name('admin.disease.settings.save')
    ->middleware('auth');
Route::get('/admin/faq-settings', [AdminController::class, 'faqSettings'])
    ->name('admin.faq.settings')
    ->middleware('auth');
Route::post('/admin/faq-settings', [AdminController::class, 'saveFaqSettings'])
    ->name('admin.faq.settings.save')
    ->middleware('auth');

Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.delete');

Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan');
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

Route::get('/gejala', [GejalaController::class, 'index'])->name('gejala');

Route::delete('/admin/ulasan/{id}', [UlasanController::class, 'destroy'])
    ->name('ulasan.delete');

Route::get('/', function () {
    $ulasan = Ulasan::latest()->take(3)->get();
    return view('landing', compact('ulasan'));
});

Route::get('/biodata', function () {
    return view('biodata');
})->name('biodata');

Route::get('/loading', function () {
    return view('loading');
})->name('loading');

Route::post('/diagnosis/proses', [DiagnosisController::class, 'prosesDiagnosis'])->name('diagnosis.proses');

Route::get('/hasil-diagnosis', [DiagnosisController::class, 'hasil'])->name('hasil-diagnosis');

Route::get('/faq', [AdminController::class, 'faqPage'])->name('faq');

// Admin Routes
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
Route::post('/biodata/simpan', [DiagnosisController::class, 'simpanBiodata'])->name('biodata.simpan');
Route::get('/admin/statistik', [AdminController::class, 'statistik'])->name('admin.statistik');