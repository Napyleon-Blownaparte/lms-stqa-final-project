<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::all();
        return view('flights.index', [
            'flights' => $flights
        ]);
    }

    public function show(Flight $flight)
    {
        return view('flights.show', [
            'flight' => $flight
        ]);
    }


}
