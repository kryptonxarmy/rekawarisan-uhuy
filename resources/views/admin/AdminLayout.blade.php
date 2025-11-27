<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - Rekawarisan</title>
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    <link rel="stylesheet" href="/assets/app-BHZ6hVf-.css">
    <script src="/assets/app-kGY04szw.js" defer></script>

</head>

<body class="bg-[#FFFFFF] font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-72 bg-[#0F766E] text-white flex-shrink-0 shadow-xl">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-6">
                    <a href="{{ route('beranda') }}" class="flex items-center gap-2">
                        <img src="/images/logo rekawarisan.svg" alt="logo reka warisan">
                        <span class="font-bold text-lg">REKAWARISAN</span>
                    </a>
                </div>

                <!-- Menu Utama -->
                <div class="mb-6">
                    <div class="px-4 text-xs uppercase tracking-wider text-white/70 mb-2">Menu Utama</div>
                    <nav class="flex flex-col gap-1">
                        <a href="{{ route('admin.dashboard') }}"
                            class="py-2.5 px-4 rounded-lg hover:bg-white/10 flex items-center gap-3">
                            <x-heroicon-s-home class="h-5 w-5 text-white" />
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('admin.articles.index') }}"
                            class="py-2.5 px-4 rounded-lg hover:bg-white/10 flex items-center gap-3">
                            <x-heroicon-s-book-open class="h-5 w-5 text-white" />
                            <span>Kelola Pustaka</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }}"
                            class="py-2.5 px-4 rounded-lg hover:bg-white/10 flex items-center gap-3">
                            <x-heroicon-s-tag class="h-5 w-5 text-white" />
                            <span>Kategori Warisan</span>
                        </a>
                    </nav>
                </div>

                <!-- Jejak Maestro -->
                <div class="mb-6">
                    <div class="px-4 text-xs uppercase tracking-wider text-white/70 mb-2">Jejak Maestro</div>
                    <nav class="flex flex-col gap-1">
                        {{-- OLD MISSION SYSTEM - DEPRECATED --}}
                        {{-- <a href="{{ route('admin.missions.index') }}"
                            class="py-2.5 px-4 rounded-lg hover:bg-white/10 flex items-center gap-3 opacity-60">
                            <x-heroicon-s-clipboard-document-check class="h-5 w-5 text-white" />
                            <span>Kelola Misi (Old)</span>
                            <span class="ml-auto text-xs bg-red-500 text-white px-2 py-1 rounded">DEPRECATED</span>
                        </a> --}}

                        <a href="{{ route('admin.daily-missions.index') }}"
                            class="py-2.5 px-4 rounded-lg hover:bg-white/10 flex items-center gap-3">
                            <x-heroicon-s-calendar-days class="h-5 w-5 text-white" />
                            <span>Misi Harian</span>
                        </a>
                        <a href="{{ route('admin.leaderboard.index') }}"
                            class="py-2.5 px-4 rounded-lg hover:bg-white/10 flex items-center gap-3">
                            <x-heroicon-s-chart-bar class="h-5 w-5 text-white" />
                            <span>Leaderboard</span>
                        </a>
                        <a href="{{ route('admin.badges.index') }}"
                            class="py-2.5 px-4 rounded-lg hover:bg-white/10 flex items-center gap-3">
                            <x-heroicon-s-star class="h-5 w-5 text-white" />
                            <span>Badge</span>
                        </a>
                    </nav>
                </div>

                <!-- Lainnya -->
                <div>
                    <div class="px-4 text-xs uppercase tracking-wider text-white/70 mb-2">Lainnya</div>
                    <nav class="flex flex-col gap-1">
                        <a href="{{ route('admin.inbox.index') }}"
                            class="py-2.5 px-4 rounded-lg hover:bg-white/10 flex items-center gap-3">
                            <x-heroicon-s-envelope class="h-5 w-5 text-white" />
                            <span>Kotak Masuk</span>
                        </a>
                        <!-- Tombol Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full py-2.5 px-4 rounded-lg flex items-center gap-3 text-left hover:bg-white/10 text-white mt-4">
                                <x-heroicon-s-arrow-left-on-rectangle class="h-5 w-5 text-white" />
                                <span>Logout</span>
                            </button>
                        </form>

                        <!-- Modal Logout -->
                        <div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                            <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
                                <h2 class="text-xl font-bold text-gray-800 mb-4">Konfirmasi Logout</h2>
                                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin keluar dari admin panel?</p>
                                <div class="flex justify-end gap-3">
                                    <button onclick="hideLogoutModal()" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Batal</button>
                                    <form id="logoutForm" method="POST" action="{{ route('admin.logout') }}">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-[#FFFFFF]">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>
<script>
    function showLogoutModal() {
        document.getElementById('logoutModal').classList.remove('hidden');
    }
    function hideLogoutModal() {
        document.getElementById('logoutModal').classList.add('hidden');
    }
</script>
</html>
