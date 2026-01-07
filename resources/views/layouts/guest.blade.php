<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Kependudukan') | Bina Desa</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        dark: {
                            900: '#0B0B0F', // Main bg
                            800: '#12121A', // Secondary bg
                            700: '#1A1A23', // Card bg
                        },
                        primary: {
                            500: '#8B5CF6',
                            600: '#7C3AED',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #0B0B0F;
            color: #E2E8F0;
        }
        .glass-nav {
            background: rgba(11, 11, 15, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .card-gradient {
            background: linear-gradient(145deg, #1A1A23 0%, #12121A 100%);
        }
    </style>
</head>
<body class="antialiased font-sans selection:bg-purple-500 selection:text-white">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-purple-600 to-blue-500 flex items-center justify-center shadow-lg shadow-purple-500/20">
                        <i class="fa-solid fa-building-columns text-white text-lg"></i>
                    </div>
                    <a href="{{ route('guest.dashboard') }}" class="font-bold text-xl tracking-tight text-white">
                        Bina <span class="text-purple-500"> Desa Kependudukan</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('guest.dashboard') }}" class="text-sm font-medium text-gray-300 hover:text-white transition-colors {{ request()->routeIs('guest.dashboard') ? 'text-white' : '' }}">Home</a>
                    
                    <div class="relative group">
                        <button class="text-sm font-medium text-gray-300 hover:text-white transition-colors flex items-center gap-1">
                            Data Kependudukan <i class="fa-solid fa-chevron-down text-xs opacity-50"></i>
                        </button>
                        <div class="absolute top-full left-0 w-56 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform translate-y-2 group-hover:translate-y-0">
                            <div class="bg-[#1A1A23] border border-white/5 rounded-xl shadow-xl overflow-hidden p-2">
                                <a href="{{ route('guest.warga.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white rounded-lg">Data Warga</a>
                                <a href="{{ route('guest.keluarga-kk.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white rounded-lg">Keluarga KK</a>
                                <a href="{{ route('guest.anggota-keluarga.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white rounded-lg">Anggota Keluarga</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <button class="text-sm font-medium text-gray-300 hover:text-white transition-colors flex items-center gap-1">
                            Peristiwa <i class="fa-solid fa-chevron-down text-xs opacity-50"></i>
                        </button>
                        <div class="absolute top-full left-0 w-48 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform translate-y-2 group-hover:translate-y-0">
                            <div class="bg-[#1A1A23] border border-white/5 rounded-xl shadow-xl overflow-hidden p-2">
                                <a href="{{ route('guest.kelahiran.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white rounded-lg">Kelahiran</a>
                                <a href="{{ route('guest.kematian.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white rounded-lg">Kematian</a>
                                <a href="{{ route('guest.pindah.index') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 hover:text-white rounded-lg">Pindah</a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('guest.media.index') }}" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Galeri Media</a>
                </div>


            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-white/5 bg-[#08080C] pt-20 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <!-- Brand & Description -->
                <div class="col-span-1">
                    <h3 class="text-2xl font-bold text-white mb-6">Bina<span class="text-purple-500"> Desa Kependudukan</span></h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-8">
                        Sistem Informasi Manajemen Kependudukan Desa yang transparan, akuntabel, dan melayani masyarakat dengan sepenuh hati untuk kemajuan desa.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fa-brands fa-facebook-f text-lg"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fa-brands fa-twitter text-lg"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fa-brands fa-instagram text-lg"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fa-brands fa-youtube text-lg"></i></a>
                    </div>
                </div>
                
                <!-- Layanan -->
                <div>
                    <h4 class="text-white font-semibold mb-6">Layanan</h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li><a href="{{ route('guest.warga.index') }}" class="hover:text-purple-500 transition-colors">Data Kependudukan</a></li>
                        <li><a href="{{ route('guest.keluarga-kk.index') }}" class="hover:text-purple-500 transition-colors">Kartu Keluarga</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition-colors">Surat Menyurat</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition-colors">Layanan Mandiri</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition-colors">Pengaduan Masyarakat</a></li>
                    </ul>
                </div>

                <!-- Informasi -->
                <div>
                    <h4 class="text-white font-semibold mb-6">Informasi Publik</h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-purple-500 transition-colors">Berita Desa</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition-colors">Agenda Kegiatan</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition-colors">Transparansi Anggaran</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition-colors">Produk Hukum</a></li>
                        <li><a href="{{ route('guest.media.index') }}" class="hover:text-purple-500 transition-colors">Galeri Desa</a></li>
                    </ul>
                </div>

                <!-- Pemerintahan -->
                <div>
                    <h4 class="text-white font-semibold mb-6">Pemerintahan</h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-purple-500 transition-colors">Profil Desa</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition-colors">Visi & Misi</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition-colors">Struktur Organisasi</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition-colors">Lembaga Desa</a></li>
                        <li><a href="#" class="hover:text-purple-500 transition-colors">Peta Desa</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-500">© 2026 Bina Desa Kependudukan. All rights reserved.</p>
                <div class="flex gap-8 text-sm text-gray-500">
                    <a href="#" class="hover:text-purple-500 transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-purple-500 transition-colors">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-purple-500 transition-colors">Peta Situs</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
