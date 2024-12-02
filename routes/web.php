<?php

use App\Models\Booking;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomInformationController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('dashboard', [
        'booking' => Booking::all()
    ]);
})->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard', [
        'booking' => Booking::all()
    ]);
})->name('dashboard');




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
    ->only(['index', 'store']);

Route::resource('roomInformation', RoomInformationController::class)
    ->only(['index']);
    //->middleware(['auth', 'verified']);


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

    Route::post('/add_booking', [BookingController::class, 'add_booking'])->name('add_booking');
    Route::post('/search_room', [BookingController::class, 'search_room'])->name('search.room');
    Route::post('/search_date', [BookingController::class, 'search_date'])->name('search.date');

   // Route::get('/selectroom', [BookingController::class, 'viewroom']);
    //Route::get('confirmbooking/{roomId}/{userCheckIn}/{userCheckOut}', [BookingController::class, 'confirm_booking']);
    Route::get('detailedroom', [BookingController::class, 'viewdetail']);
    //Route::post('/confirm_booking', [BookingController::class, 'confirm_booking'])->name('confirm_booking');
    Route::post('/booking_overview', [BookingController::class, 'booking_overview'])->name('booking_overview');
    Route::post('/create_booking', [BookingController::class, 'create_booking'])->name('create_booking');
    Route::post('/processing_payment', [BookingController::class, 'processing_payment'])->name('processing_payment');
    Route::post('/search_room_noId', [BookingController::class, 'search_room_noId'])->name('search_room_noId');

    //Route::post('bookincomplete/{roomId}/{userCheckIn}/{userCheckOut}', [BookingController::class, 'confirm_booking'])->name('confirm_booking');
    Route::post('/booking_payment', [BookingController::class, 'booking_payment'])->name('booking_payment');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
