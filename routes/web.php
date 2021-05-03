<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}

Route::get('/', [PetController::class, 'index'])->name('pet.index');
Route::get('/pets/{id}/show', [PetController::class, 'show'])->name('pet.show');

Route::get('/about', function(){ return view('about'); })->name('about');

Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');

Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware(['custom-auth'])->group(function(){
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/pets/add', [PetController::class, 'add'])->name('pet.add');
    Route::post('/pets/store', [PetController::class, 'store'])->name('pet.store');
    Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('pet.edit');
    Route::post('/pets/{id}/update', [PetController::class, 'update'])->name('pet.update');
    Route::post('/pets/{id}/remove', [PetController::class, 'remove'])->name('pet.remove');

    Route::post('/pets/{id}/favorite/add', [FavoriteController::class, 'add'])->name('favorite.add');
    Route::post('/pets/{id}/favorite/remove', [FavoriteController::class, 'remove'])->name('favorite.remove');
});