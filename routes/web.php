<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\LocationController;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// User Management Routes
Route::resource('users', UserController::class);

// Minecraft Routes
Route::view('/minecraft', 'minecraft.index')->name('minecraft.index');
Route::view('/minecraft/minigame', 'minecraft.minigame')->name('minecraft.minigame');

// routes/web.php
Route::get('minecraft/story', [RoleController::class, 'userIndex'])->name('minecraft.story.index');
Route::get('minecraft/story/{role}', [RoleController::class, 'show'])->name('minecraft.story.show');

// Rute Admin - hanya dapat diakses oleh admin yang terautentikasi
Route::middleware('auth')->prefix('minecraft/admin')->as('minecraft.admin.')->group(function () {
    Route::resource('roles', RoleController::class);  // CRUD untuk roles
    Route::resource('tools', ToolController::class);  // CRUD untuk tools
    Route::resource('locations', LocationController::class);  // CRUD untuk locations
});

// Doomsday Routes
Route::view('/doomsday', 'doomsday.index')->name('doomsday.index');

// About Page Route
Route::view('/about', 'about')->name('about.index');
