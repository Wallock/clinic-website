<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/services', [HomeController::class, 'services'])->name('services');

// Doctors Routes
Route::prefix('doctors')->name('doctors.')->group(function () {
    Route::get('/', [DoctorController::class, 'index'])->name('index');
    Route::get('/search', [DoctorController::class, 'search'])->name('search');
    Route::get('/{doctor}', [DoctorController::class, 'show'])->name('show');
});

// Articles Routes
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/search', [ArticleController::class, 'search'])->name('search');
    Route::get('/category/{category}', [ArticleController::class, 'category'])->name('category');
    Route::get('/tag/{tag}', [ArticleController::class, 'tag'])->name('tag');
    Route::get('/{article}', [ArticleController::class, 'show'])->name('show');
});

// Authentication Routes
Auth::routes([
    'register' => false, // Disable registration
    'reset' => true,     // Enable password reset
    'verify' => false    // Disable email verification
]);

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');

    // Articles Management
    Route::resource('articles', AdminArticleController::class);
    Route::post('articles/bulk-action', [AdminArticleController::class, 'bulkAction'])->name('articles.bulk-action');

    // Doctors Management (placeholder for future implementation)
    Route::get('/doctors', function () {
        return view('admin.doctors.index');
    })->name('doctors.index');

    // Services Management (placeholder for future implementation)
    Route::get('/services', function () {
        return view('admin.services.index');
    })->name('services.index');
});

// API Routes for AJAX calls
Route::prefix('api')->middleware('web')->group(function () {
    Route::get('/articles/search', [ArticleController::class, 'search'])->name('api.articles.search');
    Route::get('/doctors/search', [DoctorController::class, 'search'])->name('api.doctors.search');
});