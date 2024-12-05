@extends('layouts.app')

@section('main')
<h1 class="font-bold text-3xl text-center">Airplane Booking System</h1>
<div class="flex justify-between">
    <h1>Ticket Booking For </h1>
    <h1>{{ $flight->flight_code  }}</h1>
</div>
    <div class="border-2 border-gray-500"></div>

    <div>
        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf
            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <!-- Passenger Name -->
                <div class="sm:col-span-2">
                    <label for="passenger_name" class="block text-sm font-semibold leading-6 font-extrabold">Passenger name</label>
                    <div class="mt-2.5">
                        <input
                            type="text"
                            name="passenger_name"
                            id="passenger_name"
                            value="{{ old('passenger_name') }}"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 font-extrabold shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('passenger_name') ring-red-500 @enderror"
                        >
                        @error('passenger_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Passenger Phone -->
                <div class="sm:col-span-2">
                    <label for="passenger_phone" class="block text-sm font-semibold leading-6 font-extrabold">Passenger phone</label>
                    <div class="mt-2.5">
                        <input
                            type="text"
                            name="passenger_phone"
                            id="passenger_phone"
                            value="{{ old('passenger_phone') }}"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 font-extrabold shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('passenger_phone') ring-red-500 @enderror"
                        >
                        @error('passenger_phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Seat Number -->
                <div class="sm:col-span-2">
                    <label for="seat_number" class="block text-sm font-semibold leading-6 font-extrabold">Seat number</label>
                    <div class="mt-2.5">
                        <input
                            type="text"
                            name="seat_number"
                            id="seat_number"
                            value="{{ old('seat_number') }}"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 font-extrabold shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('seat_number') ring-red-500 @enderror"
                        >
                        @error('seat_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="block text-center no-underline rounded h-10 w-32 self-end text-white bg-gradient-to-r from-cyan-600 to-blue-500 font-bold transition duration-100 hover:scale-105 hover:shadow-2xl">Book Ticket</button>
            <a href="{{ route('flights.index') }}" class="block text-center no-underline rounded h-10 w-32 self-end text-gray-500 mt-4">Cancel</a>
        </form>
    </div>
@endsection
