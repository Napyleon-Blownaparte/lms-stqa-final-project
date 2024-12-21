<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('flights.index');
});

Route::get('/dashboard', function () {
    return redirect()->route('flights.index');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
        Route::get('/flights/ticket/{flight:id}', [FlightController::class, 'show'])->name('flights.show');
        Route::get('/flights/book/{flight:id}', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/ticket/submit/', [TicketController::class, 'store'])->name('tickets.store');

        Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
        Route::get('/flights/ticket/{flight:id}', [FlightController::class, 'show'])->name('flights.show');
        Route::match(['patch','put'],'/ticket/board/{ticket:id}', [TicketController::class, 'update'])->name('tickets.update');
        Route::delete('/ticket/delete/{ticket:id}', [TicketController::class, 'delete'])->name('tickets.delete');

});

require __DIR__ . '/auth.php';
