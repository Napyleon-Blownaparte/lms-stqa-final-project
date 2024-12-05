@extends('layouts.app')

@section('main')
    <div class="my-12 ml-2">
        <div class="flex flex-wrap justify-center md:justify-center">
            @if ($message = Session::get('success'))
                <script>
                    alert("Tambah data sukses!")
                </script>
            @endif
            @foreach($flights as $flight)
            <div class="card shadow-xl m-2 w-[26rem] md:w-[19rem] cursor-pointer p-6">
                <div class="card-body grid grid-rows-[auto,auto,auto,1fr,auto]">
                    <h5 class="card-title font-bold text-black">{{ $flight->flight_code }}</h5>
                    <h5>{{ $flight->origin  }} <span>--> {{ $flight->destination  }}</span></h5>
                    <h5 class="font-bold">Departure</h5>
                    <p>{{ $flight->departure_time  }}</p>
                    <h5 class="font-bold">Arrived</h5>
                    <p>{{ $flight->arrival_time  }}</p>
                </div>
                <div class="flex justify-between gap-7 mt-5">
                    <a href="{{ url('flights/book/' . $flight->id)  }}" class="pt-2 block text-center no-underline rounded h-10 w-32 self-end text-white bg-gradient-to-r from-cyan-600 to-blue-500 font-bold transition duration-100 hover:scale-105 hover:shadow-2xl">Book Ticket</a>
                    <a href="{{ url('flights/ticket/' . $flight->id)  }}" class="pt-2 block text-center no-underline rounded h-10 w-32 self-end text-white bg-gradient-to-r from-pink-600 to-purple-500 font-bold transition duration-100 hover:scale-105 hover:shadow-2xl">View Details</a>
                </div>

            </div>
            @endforeach
        </div>


@endsection
