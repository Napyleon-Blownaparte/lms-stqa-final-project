<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create(Flight $flight)
    {
        return view('tickets.create', [
            'flight' => $flight
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'passenger_name' => 'required|string|max:255',
            'passenger_phone' => 'required|digits_between:10,14',
            'seat_number' => 'required|string|max:3',
        ]);


        $prev = url()->previous();
        $flight_id = (int)substr($prev, -1);

        Flight::find($flight_id)->tickets()->create(array_merge($validated, ['boarding_time' => now()]));

        return redirect(route('flights.index'))->with(['success' => 'Tambah tiket berhasil']);
    }



    public function edit(Ticket $ticket)
    {

    }

    public function delete(Ticket $ticket)
    {
        if ($ticket->is_boarding) {
            return(redirect(route('flights.index')));
        }
        $ticket->delete();
        return redirect(route('flights.index'));
    }
}
