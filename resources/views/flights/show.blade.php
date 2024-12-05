@extends('layouts.app')

@section('main')
    <h1 class="font-bold text-2xl text-center">Airplane Booking System</h1>
    <div class="flex justify-between">
        <h1 class="font-bold text-xl">Ticket Details for {{ $flight->flight_code  }}</h1>
    </div>
    <table>
        <thead>
        <tr>
            <th>No.</th>
            <th>Passenger Name</th>
            <th>Passenger Phone</th>
            <th>Seat Number</th>
            <th>Boarding</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
            @foreach($flight->tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id  }}</td>
                    <td>{{ $ticket->passenger_name  }}</td>
                    <td>{{ $ticket->passenger_phone  }}</td>
                    <td>{{ $ticket->seat_number  }}</td>
                    <td>{{ $ticket->boarding_time  }}</td>
                    <form method="POST" action="{{ route('tickets.delete', $ticket) }}">
                        @csrf
                        @method('DELETE')
                        <td><button type="submit">DELETE</button></td>
                    </form>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
