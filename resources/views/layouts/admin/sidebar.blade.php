<aside class="w-64 min-h-screen bg-white shadow-xl rounded-3xl flex flex-col p-6">

    <!-- Logo -->
    <div class="flex items-center mb-10 gap-3 px-2">
        <img src="{{ asset('assets-admin/img/logo-ct-dark.png') }}" class="h-8" alt="Logo">
        <span class="font-semibold text-[#5e72e4] text-lg">Argon Dashboard 2</span>
    </div>

    <!-- Menu -->
    <nav class="flex-1">
        <ul class="space-y-1">

            {{-- Dashboard --}}
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl 
                          {{ request()->is('dashboard') ? 'bg-[#5e72e4] text-white shadow-md font-semibold' : 'hover:bg-gray-100 text-gray-700' }}">
                    <i class="ni ni-shop text-lg"></i>
                    Dashboard
                </a>
            </li>

            {{-- DATA PENDUDUK --}}
            <li x-data="{ 
                    open: {{ 
                        request()->is('keluarga_kk*') || 
                        request()->is('warga*') || 
                        request()->is('kelahiran*') || 
                        request()->is('kematian*') || 
                        request()->is('pindah*') || 
                        request()->is('media*')
                        ? 'true' : 'false' 
                    }} 
                }">

                <!-- Button -->
                <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-3 rounded-xl hover:bg-gray-100 text-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="ni ni-collection text-lg text-purple-500"></i>
                        <span>Data Penduduk</span>
                    </div>

                    <i class="ni ni-bold-down text-xs transition"
                       :class="open ? 'rotate-180' : ''"></i>
                </button>

                <!-- Dropdown -->
                <ul x-show="open" x-transition class="pl-10 pr-4 space-y-1 mt-2">

                {{-- Data Warga --}}
                    <li>
                        <a href="{{ route('warga.index') }}"
                           class="flex items-center gap-2 px-3 py-2 rounded-lg
                                  {{ request()->is('warga*') 
                                     ? 'bg-[#5e72e4] text-white font-semibold shadow'
                                     : 'hover:bg-gray-100 text-gray-700' }}">
                            <i class="ni ni-single-02 text-sm"></i>
                            <span>Data Warga</span>
                        </a>
                    </li>


                    {{-- Data Keluarga --}}
                    <li>
                        <a href="{{ route('keluarga_kk.index') }}"
                           class="flex items-center gap-2 px-3 py-2 rounded-lg
                                  {{ request()->is('keluarga_kk*') 
                                     ? 'bg-[#5e72e4] text-white font-semibold shadow' 
                                     : 'hover:bg-gray-100 text-gray-700' }}">
                            <i class="ni ni-single-copy-04 text-sm"></i>
                            <span>Data Keluarga</span>
                        </a>
                    </li>

                    
                  {{-- Kelahiran --}}
                    <li>
                        <a href="{{ route('peristiwa_kelahiran.index') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg
                                {{ request()->is('peristiwa_kelahiran*') 
                                    ? 'bg-[#5e72e4] text-white font-semibold shadow'
                                    : 'hover:bg-gray-100 text-gray-700' }}">
                            <i class="ni ni-badge text-sm"></i>
                            <span>Data Kelahiran</span>
                        </a>
                    </li>

                    {{-- Kematian --}}
                    <li>
                        <a href="{{ route('peristiwa_kematian.index') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg
                                {{ request()->is('peristiwa_kematian*') 
                                    ? 'bg-[#5e72e4] text-white font-semibold shadow'
                                    : 'hover:bg-gray-100 text-gray-700' }}">
                            <i class="ni ni-fat-remove text-sm"></i>
                            <span>Data Kematian</span>
                        </a>
                    </li>

                    {{-- Pindah --}}
                    <li>
                        <a href="{{ route('peristiwa_pindah.index') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg
                                {{ request()->is('peristiwa_pindah*') 
                                    ? 'bg-[#5e72e4] text-white font-semibold shadow'
                                    : 'hover:bg-gray-100 text-gray-700' }}">
                            <i class="ni ni-send text-sm"></i>
                            <span>Data Pindah</span>
                        </a>
                    </li>


                    {{-- Media --}}
                    <li>
                        <a href="{{ route('media.index') }}"
                           class="flex items-center gap-2 px-3 py-2 rounded-lg
                                  {{ request()->is('media*') 
                                     ? 'bg-[#5e72e4] text-white font-semibold shadow'
                                     : 'hover:bg-gray-100 text-gray-700' }}">
                            <i class="ni ni-folder-17 text-sm"></i>
                            <span>Media</span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </nav>

</aside>
