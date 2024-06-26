<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingsController;

// Главная страница
Route::get('/home', [PostController::class, 'home'])->name('home');

// Страница категорий и посты по категориям
Route::get('/allcategories', [CategoryController::class, 'indexFront'])->name('categories.front');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}', [PostController::class, 'showByCategory'])->name('categories.showByCategory');

// Маршруты для постов
Route::resource('posts', PostController::class)->only(['index', 'show']);

// Главная страница и домашняя страница
Route::get('/', function () {
    if (auth()->check()) {
        return view('dashboard');
    } else {
        return redirect()->route('home');
    }
})->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Маршруты для постов (создание, редактирование, удаление)
    Route::resource('posts', PostController::class);

    // Маршруты для пользователей и страниц
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');

    // Полные маршруты для категорий
    Route::resource('categories', CategoryController::class);
    Route::get('/categories/{category}', [PostController::class, 'showByCategory'])->name('categories.show');
    
    // Маршруты для настроек
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});
