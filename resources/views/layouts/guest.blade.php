<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Guest Panel') | Sistem Kependudukan</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin-volt/css/argon-dashboard-tailwind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin-volt/css/nucleo-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin-volt/css/nucleo-svg.css') }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'display': ['"Plus Jakarta Sans"', 'Inter', 'ui-sans-serif', 'system-ui'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-slate-50 via-white to-cyan-50 min-h-full text-slate-800 font-display">
<div class="fixed inset-0 pointer-events-none">
    <div class="absolute -top-32 -right-20 w-96 h-96 bg-cyan-200/30 blur-[120px] rounded-full"></div>
    <div class="absolute -bottom-20 -left-10 w-[32rem] h-[32rem] bg-blue-200/20 blur-[140px] rounded-full"></div>
</div>
<div class="relative min-h-screen">
    <div class="flex">
        <aside class="sidenav navbar navbar-vertical navbar-expand-xs fixed-start bg-white/90 backdrop-blur-2xl shadow-2xl border border-white/40 rounded-r-[2.5rem] min-h-screen w-72 hidden lg:flex">
            <div class="w-full px-6 py-6 space-y-6">
                <div class="flex items-center justify-between">
                    <a class="text-lg font-semibold text-blue-600 flex items-center gap-2" href="{{ route('guest.dashboard') }}">
                        <img src="{{ asset('assets-admin-volt/img/logo-ct.png') }}" class="h-8 w-8" alt="Argon">
                        Bina Desa - Guest
                    </a>
                    <button class="btn btn-link text-sm lg:hidden" id="close-sidenav">
                        <i class="ni ni-fat-remove text-xl"></i>
                    </button>
                </div>
                <hr class="border-slate-200/60">
                <ul class="navbar-nav flex flex-col gap-3">
                    <li>
                        <p class="uppercase text-xs font-semibold text-slate-400">Navigasi</p>
                    </li>
                    <li>
                        <a href="{{ route('guest.dashboard') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold {{ request()->routeIs('guest.dashboard') ? 'bg-gradient-to-r from-blue-600 to-cyan-400 text-white shadow-lg' : 'text-slate-600 hover:text-blue-600' }}">
                            <i class="ni ni-chart-bar-32 text-lg"></i>
                            Dashboard Guest
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('guest.keluarga-kk.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold {{ request()->routeIs('guest.keluarga-kk.*') ? 'bg-gradient-to-r from-blue-600 to-cyan-400 text-white shadow-lg' : 'text-slate-600 hover:text-blue-600' }}">
                            <i class="ni ni-single-copy-04 text-lg"></i>
                            Data Keluarga KK
                        </a>
                    </li>
                    <li class="pt-4">
                        <p class="uppercase text-xs font-semibold text-slate-400">Referensi</p>
                    </li>
                    <li>
                        <a href="https://themewagon.com/themes/argon-dashboard-tailwind/" target="_blank" class="nav-link flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold text-slate-600 hover:text-blue-600">
                            <i class="ni ni-world text-lg"></i>
                            Template Argon Dashboard Tailwind
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="flex-1 lg:ml-72">
            <nav class="sticky top-0 z-30 bg-white/90 backdrop-blur-xl shadow-lg shadow-blue-100/50 py-4 px-6 flex items-center justify-between border-b border-white/40">
                <div class="flex items-center gap-3">
                    <button class="lg:hidden text-slate-600 text-2xl" id="open-sidenav">
                        <i class="ni ni-align-left-2"></i>
                    </button>
                    <div>
                        <p class="text-xs uppercase text-slate-500 tracking-wide">Panel Guest</p>
                        <h1 class="text-xl font-semibold text-slate-800">@yield('page-title', 'Ringkasan')</h1>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="px-3 py-1 text-xs font-semibold text-blue-600 bg-blue-100 rounded-full">Guest Role</span>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-slate-600 text-right leading-tight">
                            Guest User<br>
                            <span class="text-xs text-slate-400">Pengelola KK</span>
                        </span>
                        <img src="{{ asset('assets-admin-volt/img/team-3.jpg') }}" class="w-10 h-10 rounded-full border-2 border-white shadow" alt="avatar">
                    </div>
                </div>
            </nav>
            <main class="p-4 md:p-8 space-y-4">
                @if(session('success'))
                    <div class="rounded-2xl border border-emerald-100 bg-emerald-50 text-emerald-700 px-5 py-4 shadow-xl shadow-emerald-100/60 flex items-start gap-3">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-emerald-500 text-white">
                            <i class="ni ni-check-bold"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-emerald-700">Berhasil</p>
                            <p class="text-sm leading-tight">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="rounded-2xl border border-rose-100 bg-rose-50 text-rose-700 px-5 py-4 shadow-xl shadow-rose-100/60 flex items-start gap-3">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-rose-500 text-white">
                            <i class="ni ni-fat-remove"></i>
                        </span>
                        <div>
                            <p class="font-semibold text-rose-700">Gagal</p>
                            <p class="text-sm leading-tight">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</div>
<script src="{{ asset('assets-admin-volt/js/plugins/chartjs.min.js') }}"></script>
<script src="{{ asset('assets-admin-volt/js/argon-dashboard-tailwind.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidenav = document.querySelector('aside.sidenav');
        const openBtn = document.getElementById('open-sidenav');
        const closeBtn = document.getElementById('close-sidenav');

        const toggleNav = (show) => {
            if (!sidenav) return;
            if (show) {
                sidenav.classList.remove('hidden');
                sidenav.classList.add('flex');
            } else {
                sidenav.classList.add('hidden');
                sidenav.classList.remove('flex');
            }
        };

        openBtn?.addEventListener('click', () => toggleNav(true));
        closeBtn?.addEventListener('click', () => toggleNav(false));
    });
</script>
@stack('scripts')
</body>
</html>

