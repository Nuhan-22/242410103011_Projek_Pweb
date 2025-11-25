 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default Title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('scripts/functions.js') }}"></script>
 <body class="bg-gray-50">
        <script>
            var baseUrl = "{{ asset('') }}";

        </script>

<header>
        @include('visitor-pages.partials.navbar')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('visitor-pages.partials.footer')
    </footer>

 </body>
 </html>
