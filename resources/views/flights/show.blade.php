@extends('layouts.app')

@section('main')
    <h1 class="font-bold text-2xl text-center my-5">Airplane Booking System</h1>
    <div class="flex justify-between my-5">
        <h1 class="font-bold text-xl">Ticket Details for {{ $flight->flight_code }}</h1>
    </div>

    <table id="ticketsTable" class="display nowrap stripe hover" style="width:100%">
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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ticket->passenger_name }}</td>
                    <td>{{ $ticket->passenger_phone }}</td>
                    <td>{{ $ticket->seat_number }}</td>
                    <td>
                        @if ($ticket->is_boarding)
                            Confirmed at {{ $ticket->boarding_time }}
                        @else
                            <form method="POST" action="{{ route('tickets.update', $ticket) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="is_boarding" value="1">
                                <button type="submit" class="px-2 py-1 bg-blue-500 text-white rounded">Confirm</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('tickets.delete', $ticket) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#ticketsTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthChange: true,
                ordering: true,
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ tickets per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ tickets",
                    infoEmpty: "No tickets available",
                    emptyTable: "No tickets found",
                }
            });
        });
    </script>

@endsection

