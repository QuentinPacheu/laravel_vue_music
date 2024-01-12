<?php

use App\http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TrackController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [TrackController::class, 'index'])->name('track.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('playlists', PlaylistController::class);

    Route::middleware(['admin'])->group(function () {
        Route::get('/track/create', [TrackController::class, 'create'])->name('track.create');
        Route::post('/track', [TrackController::class, 'store'])->name('track.store');
        Route::get('track/{track}/edit', [TrackController::class, 'edit'])->name('track.edit');
        Route::put('track/{track}', [TrackController::class, 'update'])->name('track.update');
        Route::delete('track/{track}', [TrackController::class,'destroy'])->name('track.destroy');
    });
    
});

// Route::get('test', [HomeController::class, 'index']);
