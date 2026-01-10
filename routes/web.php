<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HallController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PaymentController;

use App\Http\Controllers\Admin\ShowtimeController;
use App\Http\Controllers\User\SeatController as UserSeatController;
use App\Http\Controllers\User\MovieController as UserMovieController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\User\ShowtimeController as UserShowtimeController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

require __DIR__.'/admin-auth.php';

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth:admin')
    ->group(function () {
        Route::resource('movies', MovieController::class);
        Route::resource('showtimes', ShowtimeController::class);
        Route::resource('seats', SeatController::class);
        Route::resource('halls', HallController::class);
        Route::resource('bookings', BookingController::class);
        Route::resource('payments', PaymentController::class);
        Route::resource('users', UserController::class);
    }    
);

Route::prefix('user')->middleware('auth')->group(function () {
    
});

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {

    Route::get('/movies', [UserMovieController::class, 'index'])->name('movies.index');

    Route::get('/movies/{movie}/showtimes', [UserShowtimeController::class, 'index'])->name('showtimes.index');

    Route::get('/showtimes/{showtime}/seats', [UserSeatController::class, 'index'])->name('seats.index');

    Route::post('/bookings', [UserBookingController::class, 'store'])->name('bookings.store');

    Route::get('/bookings/{booking}/confirmation', [UserBookingController::class, 'confirmation'])->name('bookings.confirmation');
    Route::get('/bookings/{booking}/qr', [UserBookingController::class, 'qr'])->name('payments.qr');
    Route::post('/bookings/{booking}/paid', [UserBookingController::class, 'markPaid'])->name('payments.paid');

});

