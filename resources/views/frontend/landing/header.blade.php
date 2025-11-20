@php
// Helper untuk Class Styling
$activeLink = 'text-teal-600 font-extrabold md:border-b-2 md:border-teal-600 transition-all duration-300';
$defaultLink = 'text-gray-700 hover:text-teal-600 hover:bg-gray-50 md:hover:bg-transparent md:border-b-2 md:border-transparent transition-all duration-300';
$mobileItem = 'block py-3 px-4';
@endphp

<nav class="bg-white fixed w-full z-20 top-0 start-0 shadow-lg border-b border-gray-100">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3 lg:p-4">
        
        <a href="{{ route('beranda') }}" class="flex items-center space-x-3 rtl:space-x-reverse flex-shrink-0 group">
            <img src="{{ asset('assets/logo-rekawarisan.png') }}" class="h-10 lg:h-12 transform group-hover:scale-105 transition-transform duration-300" alt="RekaWarisan Logo">
            <span class="self-center text-xl lg:text-2xl font-bold whitespace-nowrap text-gray-900 group-hover:text-teal-700 transition-colors duration-300">Reka Warisan</span>
        </a>

        <div class="flex items-center justify-end md:order-2 space-x-2 lg:space-x-4">

            {{-- USER BELUM LOGIN (Tombol Desktop/Tablet) --}}
            @guest
            <a href="{{ route('login') }}"
                class="hidden sm:inline-block text-teal-600 border-2 border-teal-600 hover:bg-teal-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-teal-300 font-semibold rounded-xl text-sm px-5 py-2 transition-all duration-300 transform hover:-translate-y-0.5">
                Masuk
            </a>

            <a href="{{ route('register') }}"
                class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-teal-300 font-semibold rounded-xl text-sm px-5 py-2 transition-all duration-300 transform hover:scale-[1.02]">
                Daftar
            </a>
            @endguest


            {{-- USER SUDAH LOGIN (Dropdown Profil) --}}
            @auth
            <button type="button"
                class="flex text-sm rounded-full focus:ring-4 focus:ring-teal-300 transform hover:scale-105 transition duration-150 relative"
                id="user-menu-button"
                aria-expanded="false"
                data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>

                <img class="w-10 h-10 p-0.5 rounded-full object-cover border-2 border-teal-600"
                     src="{{ Auth::user()->profile_photo_url ?? asset('assets/imguser.png') }}"
                     alt="user photo">
                <span class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 rounded-full border-2 border-white"></span>
            </button>
            
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-xl shadow-2xl border border-gray-200 min-w-[12rem]"
                id="user-dropdown">

                <div class="px-4 py-3">
                    <span class="block text-sm font-bold text-gray-900">{{ Auth::user()->name }}</span>
                    <span class="block text-xs text-teal-600 truncate">{{ Auth::user()->email }}</span>
                </div>

                <ul class="py-1" aria-labelledby="user-menu-button">

                    {{-- Hanya admin --}}
                    @if (Auth::user()->role === 'admin')
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition duration-100">
                            <i class="fas fa-chart-line w-4 me-3"></i> Dashboard Admin
                        </a>
                    </li>
                    @endif

                    {{-- Menu Semua User --}}
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition duration-100">
                            <i class="fas fa-user-circle w-4 me-3"></i> Profil Saya
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition duration-100">
                            <i class="fas fa-cog w-4 me-3"></i> Pengaturan Akun
                        </a>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition duration-100">
                                <i class="fas fa-sign-out-alt w-4 me-3"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth
            
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-lg text-teal-600 rounded-lg md:hidden hover:bg-teal-50 focus:outline-none focus:ring-2 focus:ring-teal-200 transition-colors duration-200"
                aria-controls="navbar-sticky"
                aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <i class="fas fa-bars"></i>
            </button>

        </div>

        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-0 md:p-0 mt-4 font-semibold rounded-xl bg-gray-50 border border-gray-200 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white shadow-xl md:shadow-none">

                {{-- Tautan Navigasi --}}
                <li>
                    <a href="{{ route('beranda') }}" 
                        class="{{ $mobileItem }} md:p-0 {{ request()->routeIs('beranda') ? $activeLink : $defaultLink }} {{ request()->routeIs('beranda') ? 'md:font-bold' : '' }}">
                        Beranda
                    </a>
                </li>

                <li>
                    <a href="{{ route('pustakawarisan') }}" 
                        class="{{ $mobileItem }} md:p-0 {{ request()->routeIs('pustakawarisan') ? $activeLink : $defaultLink }}">
                        Pustaka Warisan
                    </a>
                </li>

                <li>
                    <a href="{{ route('jejakmaestro') }}" 
                        class="{{ $mobileItem }} md:p-0 {{ request()->routeIs('jejakmaestro') ? $activeLink : $defaultLink }}">
                        Jejak Maestro
                    </a>
                </li>

                <li>
                    <a href="{{ route('contact') }}" 
                        class="{{ $mobileItem }} md:p-0 {{ request()->routeIs('contact') ? $activeLink : $defaultLink }} rounded-b-xl md:rounded-none">
                        Kontak
                    </a>
                </li>
                
                {{-- Aksi Mobile: Masuk/Daftar (Hanya ditampilkan di Mobile) --}}
                @guest
                <li class="md:hidden border-t border-gray-200">
                    <a href="{{ route('login') }}"
                        class="block w-full py-3 px-4 text-center text-teal-600 bg-gray-50 hover:bg-gray-100 rounded-b-xl font-bold transition-colors duration-150">
                        Masuk
                    </a>
                </li>
                <li class="md:hidden border-t border-gray-200">
                    <a href="{{ route('register') }}"
                        class="block w-full py-3 px-4 text-center text-white bg-teal-600 hover:bg-teal-700 rounded-b-xl font-bold transition-colors duration-150">
                        Daftar
                    </a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>