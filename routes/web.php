<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// User Management Routes
Route::resource('users', UserController::class);

// Minecraft Routes
Route::view('/minecraft', 'minecraft.index')->name('minecraft.index');
Route::view('/minecraft/story', 'minecraft.story')->name('minecraft.story');
Route::view('/minecraft/minigame', 'minecraft.minigame')->name('minecraft.minigame');

// Doomsday Routes
Route::view('/doomsday', 'doomsday.index')->name('doomsday.index');

// About Page Route
Route::view('/about', 'about')->name('about.index');
