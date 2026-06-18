<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\LandingController;

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
Route::get('/admin/training-settings', [AdminController::class, 'trainingDataSettings'])
    ->name('admin.training.settings')
    ->middleware('auth');
Route::post('/admin/training-settings', [AdminController::class, 'saveTrainingDataSettings'])
    ->name('admin.training.settings.save')
    ->middleware('auth');
Route::get('/admin/training-settings/{id}/symptoms', [AdminController::class, 'editTrainingSymptoms'])
    ->name('admin.training.symptoms.edit')
    ->middleware('auth');
Route::post('/admin/training-settings/{id}/symptoms', [AdminController::class, 'saveTrainingSymptoms'])
    ->name('admin.training.symptoms.save')
    ->middleware('auth');
Route::get('/admin/training-template', [AdminController::class, 'downloadTrainingTemplate'])
    ->name('admin.training.template')
    ->middleware('auth');
Route::get('/admin/training-export', [AdminController::class, 'downloadTrainingData'])
    ->name('admin.training.export')
    ->middleware('auth');

Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.delete');

Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan');
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

Route::get('/gejala', [GejalaController::class, 'index'])->name('gejala');

Route::delete('/admin/ulasan/{id}', [UlasanController::class, 'destroy'])
    ->name('ulasan.delete');
Route::post('/admin/ulasan/{id}/toggle-hide', [UlasanController::class, 'toggleHide'])
    ->name('ulasan.toggleHide')
    ->middleware('auth');

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/biodata', function () {
    return view('biodata');
})->name('biodata');

Route::get('/loading', function () {
    return view('loading');
})->name('loading');

Route::post('/diagnosis/proses', [DiagnosisController::class, 'prosesDiagnosis'])->name('diagnosis.proses');

Route::get('/hasil-diagnosis', [DiagnosisController::class, 'hasil'])->name('hasil-diagnosis');
Route::get('/hasil-diagnosis/pdf', [DiagnosisController::class, 'downloadPdf'])->name('hasil-diagnosis.pdf');

Route::get('/faq', [AdminController::class, 'faqPage'])->name('faq');

// Admin Routes
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/admin/lupa-password', [AdminController::class, 'forgotPasswordPage'])->name('admin.forgot.password');
Route::post('/admin/lupa-password/send-otp', [AdminController::class, 'sendForgotOtp'])->name('admin.forgot.sendOtp');
Route::post('/admin/lupa-password/verify-otp', [AdminController::class, 'verifyForgotOtp'])->name('admin.forgot.verifyOtp');
Route::get('/admin/lupa-password/ganti-password', [AdminController::class, 'resetPasswordPage'])->name('admin.forgot.reset.form');
Route::post('/admin/lupa-password/ganti-password', [AdminController::class, 'resetPasswordSubmit'])->name('admin.forgot.reset.submit');
Route::post('/admin/recover/send-otp', [AdminController::class, 'sendRecoveryOtp'])->name('admin.recover.sendOtp');
Route::post('/admin/recover-password', [AdminController::class, 'recoverPassword'])->name('admin.recover.password');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
Route::post('/biodata/simpan', [DiagnosisController::class, 'simpanBiodata'])->name('biodata.simpan');
Route::get('/admin/statistik', [AdminController::class, 'statistik'])->name('admin.statistik');

Route::get('/loading-diagnosis', function () {
    return view('loading');
})->name('diagnosis.loading');
