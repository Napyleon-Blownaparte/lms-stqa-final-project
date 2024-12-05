<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Flights</title>
    <!-- Tambahkan di <head> untuk CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <!-- Tambahkan sebelum </body> untuk JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    @vite('resources/css/app.css')
</head>

<body>
    @include('layouts.header')
    <main class="mx-[17em] my-[8em]">
        @yield('main')
    </main>
    @include('layouts.footer')
</body>

</html>
