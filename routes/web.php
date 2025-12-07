<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectsController;

use App\Models\About;

use App\Http\Controllers\LanguageController;
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');
Route::get('/projects/{project:slug}', [ProjectsController::class, 'show'])->name('projects.show');
// راوت تغيير اللغة
Route::get('/language/{lang}', [HomeController::class, 'switchLang'])->name('language.switch');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/en', [HomeController::class, 'en'])->name('en');



Route::post('/contact', [HomeController::class, 'store'])->name('contact.store');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('projects', ProjectController::class);
});
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('services', ServiceController::class);
});

Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    Route::resource('testimonials', TestimonialController::class);
});
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
    Route::resource('about', AboutController::class);
});
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class)->only(['index', 'edit', 'update']);
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
