<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OvernattingController;
use App\Http\Controllers\RoomController;
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
    Route::get('admin/users/users', [AdminController::class, 'viewUsers'])->name('admin.users.users');
});

Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('admin/users/selecteduser', [AdminController::class, 'viewSelectedUser'])->name('admin.selecteduser');
});

Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');

Route::resource('booking', BookingController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

Route::resource('overnatting', OvernattingController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);


    Route::middleware(['auth', IsAdmin::class])->group(function () {
        Route::get('admin/room', [RoomController::class, 'index'])->name('room');
    });

    Route::middleware(['auth', IsAdmin::class])->group(function () {
        Route::get('/admin/room', [RoomController::class, 'index'])->name('room');
        Route::get('/admin/room/create', [RoomController::class, 'create'])->name('room.create');
        Route::get('/admin/room/edit/{roomId}', [RoomController::class, 'edit'])->name('room.edit');
        Route::patch('/admin/room/edit/{roomId}', [RoomController::class, 'update'])->name('room.update');
        //Route::delete('/room', [RoomController::class, 'destroy'])->name('room.destroy');
    });

    Route::post('/add_booking', [BookingController::class, 'add_booking']);
    Route::post('/search_room', [BookingController::class, 'search_room']);
 Route::get('/selectroom', [BookingController::class, 'viewroom']);

    Route::get('detailedroom', [BookingController::class, 'viewdetail']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
