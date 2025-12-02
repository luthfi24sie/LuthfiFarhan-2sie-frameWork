<header class="w-full flex items-center justify-between px-6 py-4 text-white">

    <div>
        <nav class="text-sm mb-1 opacity-80">
            Pages / <span class="font-semibold">@yield('title', 'Dashboard')</span>
        </nav>
        <h1 class="text-2xl font-bold">@yield('title', 'Dashboard')</h1>
    </div>

    <div class="flex items-center gap-4">
        <div class="relative">
            <input
                class="rounded-xl py-2 pl-4 pr-10 text-gray-900 w-52 outline-none"
                type="text" placeholder="Search..." style="background:white;">
            <i class="ni ni-zoom-split-in absolute right-3 top-2.5 text-gray-400 text-lg"></i>
        </div>

        <a href="#" class="font-semibold text-white hover:opacity-80">Sign In</a>
    </div>

</header>
