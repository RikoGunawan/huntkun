<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\RoleController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('roles', RoleController::class);
// Route::put('/roles/{role}', [RoleController::class, 'update']);

use App\Http\Controllers\ToolController;
use App\Http\Controllers\LocationController;


Route::get('/tools', [ToolController::class, 'index']);
Route::get('/roles', [ToolController::class, 'roles']);
Route::post('/tools', [ToolController::class, 'store']);
Route::put('/tools/{tool}', [ToolController::class, 'update']);
Route::delete('/tools/{tool}', [ToolController::class, 'destroy']);

Route::get('/locations', [LocationController::class, 'index']);
Route::post('/locations', [LocationController::class, 'store']);
Route::put('/locations/{location}', [LocationController::class, 'update']);
Route::delete('/locations/{location}', [LocationController::class, 'destroy']);

Route::get('/tools/images', function () {
    $imageDirectory = public_path('storage/images/tools');
    $images = collect(scandir($imageDirectory))
        ->filter(fn($file) => in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
        ->values();
    return response()->json($images);
});

use Illuminate\Support\Facades\File;

Route::get('/storage/images/locations', function () {
    $files = File::files(public_path('storage/images/locations'));
    $images = collect($files)->map(function ($file) {
        return $file->getFilename();
    });
    return response()->json($images);
});
