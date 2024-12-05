<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::get('/flights/ticket/{flight:id}', [FlightController::class, 'show'])->name('flights.show');
Route::get('/flights/book/{flight:id}', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/ticket/submit/', [TicketController::class, 'store'])->name('tickets.store');
Route::put('/ticket/board/{ticket:id}', [TicketController::class, 'edit'])->name('tickets.edit');
Route::delete('/ticket/delete/{ticket:id}', [TicketController::class, 'delete'])->name('tickets.delete');

