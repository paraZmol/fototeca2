<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PhotographerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PhotoController as AdminPhotoController;
use App\Http\Controllers\Admin\PhotographerController as AdminPhotographerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/galeria', [GalleryController::class, 'index'])->name('galeria');
Route::get('/fotografos', [PhotographerController::class, 'index'])->name('photographers.index');
Route::get('/fotografos/{photographer}', [PhotographerController::class, 'show'])->name('photographers.show');
Route::view('/nosotros', 'about.index')->name('about');

// Auth routes (no button — accessible only by URL)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('fotos', AdminPhotoController::class)->parameters(['fotos' => 'photo']);
    Route::resource('fotografos', AdminPhotographerController::class)->parameters(['fotografos' => 'photographer']);
    Route::resource('categorias', CategoryController::class)->parameters(['categorias' => 'category']);
    Route::resource('subcategorias', SubcategoryController::class)->parameters(['subcategorias' => 'subcategory']);
    Route::resource('ubicaciones', LocationController::class)->parameters(['ubicaciones' => 'location']);
    Route::resource('etiquetas', TagController::class)->parameters(['etiquetas' => 'tag']);

    Route::resource('usuarios', UserController::class)
        ->parameters(['usuarios' => 'user'])
        ->middleware('super_admin');
});
