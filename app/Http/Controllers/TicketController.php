<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Support\Facades\Log;
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
            'seat_number' => 'required|string|regex:/^[a-zA-Z]{1}[0-9]{1,2}$/',
        ]);


        $prev = url()->previous();
        $flight_id = (int)substr($prev, -1);

        Flight::find($flight_id)->tickets()->create(array_merge($validated, ['boarding_time' => now()]));

        return redirect(route('flights.show', $flight_id))->with(['success' => 'Tambah tiket berhasil']);
    }



    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'is_boarding' => 'required|boolean',
        ]);
    
        $ticket->update([
            'is_boarding' => $validated['is_boarding'], // Set status boarding
            'boarding_time' => $validated['is_boarding'] ? now() : null, // Update boarding time jika boarding
        ]);
    
        return redirect()->back()->with('success', 'Boarding berhasil dikonfirmasi!');
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
