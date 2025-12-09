<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets-admin/img/favicon.png') }}">

    @include('layouts.admin.css')
</head>

<body class="font-sans min-h-screen bg-[#f8fafd] relative">

    <!-- Background Biru -->
    <div class="absolute w-full left-0 top-0 z-0 h-[260px] md:h-[330px] bg-[#6259ff] rounded-b-3xl overflow-hidden">
        <img src="{{ asset('assets-admin/img/shapes/wave-up.svg') }}"
             class="w-full h-full object-cover opacity-40">
    </div>

    <div class="flex min-h-screen relative z-10">
        @include('layouts.admin.sidebar')

        <div class="flex-1 flex flex-col">
            @include('layouts.admin.header')

            <main class="flex-1 p-6 mt-4">
                @yield('content')
            </main>

            @include('layouts.admin.footer')
        </div>
    </div>

    @include('layouts.admin.js')
</body>
</html>
