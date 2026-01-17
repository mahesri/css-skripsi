<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Career Recommendations App')</title>

    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

   {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

</head>
 
<body class="bg-gray-50 text-gray-900">

{{-- Navbar kalau ada --}}
@includeIf('partials.navbar')

{{-- Tempat konten halaman anak --}}
<div class="container mx-auto">
    @yield('content')
</div>

{{-- JS --}}
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
