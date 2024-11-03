<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::resource('admin', AdminController::class)
        ->only(['index', 'store']); // index will load the table data
});
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('admin/users', [AdminController::class, 'viewUsers'])->name('admin.users');
});

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('admin/selecteduser', [AdminController::class, 'viewSelectedUser'])->name('admin.selecteduser');
});


Route::resource('booking', BookingController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
