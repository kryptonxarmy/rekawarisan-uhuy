@extends('admin.AdminLayout')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#0F766E]">Dashboard Admin</h1>
        <p class="text-gray-600 mt-2">Selamat datang di panel administrasi Rekawarisan</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Artikel -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 uppercase tracking-wider">Total Artikel</p>
                    <p class="text-2xl font-bold text-[#0F766E]">127</p>
                </div>
                <div class="h-12 w-12 bg-[#0F766E] bg-opacity-10 rounded-lg flex items-center justify-center">
                    <x-heroicon-s-document-text class="h-6 w-6 text-[#0F766E]" />
                </div>
            </div>
            <div class="mt-2 flex items-center text-sm">
                <span class="text-green-600 font-medium">+12</span>
                <span class="text-gray-600 ml-1">dari bulan lalu</span>
            </div>
        </div>

        <!-- Total Fakta Cepat -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 uppercase tracking-wider">Fakta Cepat</p>
                    <p class="text-2xl font-bold text-[#059669]">84</p>
                </div>
                <div class="h-12 w-12 bg-[#059669] bg-opacity-10 rounded-lg flex items-center justify-center">
                    <x-heroicon-s-light-bulb class="h-6 w-6 text-[#059669]" />
                </div>
            </div>
            <div class="mt-2 flex items-center text-sm">
                <span class="text-green-600 font-medium">+8</span>
                <span class="text-gray-600 ml-1">dari bulan lalu</span>
            </div>
        </div>

        <!-- Pending Approval -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 uppercase tracking-wider">Pending Approval</p>
                    <p class="text-2xl font-bold text-orange-600">15</p>
                </div>
                <div class="h-12 w-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <x-heroicon-s-clock class="h-6 w-6 text-orange-600" />
                </div>
            </div>
            <div class="mt-2 flex items-center text-sm">
                <span class="text-orange-600 font-medium">Perlu review</span>
            </div>
        </div>

        <!-- Active Users -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 uppercase tracking-wider">Active Users</p>
                    <p class="text-2xl font-bold text-blue-600">1,234</p>
                </div>
                <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <x-heroicon-s-user class="h-6 w-6 text-blue-600" />
                </div>
            </div>
            <div class="mt-2 flex items-center text-sm">
                <span class="text-green-600 font-medium">+45</span>
                <span class="text-gray-600 ml-1">dari minggu lalu</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Articles -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Artikel Terbaru</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <img class="h-10 w-10 rounded-lg object-cover" src="https://via.placeholder.com/40" alt="">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">Tari Kecak dari Bali</p>
                            <p class="text-sm text-gray-500">2 jam yang lalu</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Approved
                        </span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <img class="h-10 w-10 rounded-lg object-cover" src="https://via.placeholder.com/40" alt="">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">Batik Mega Mendung</p>
                            <p class="text-sm text-gray-500">5 jam yang lalu</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <img class="h-10 w-10 rounded-lg object-cover" src="https://via.placeholder.com/40" alt="">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">Wayang Kulit Jawa</p>
                            <p class="text-sm text-gray-500">1 hari yang lalu</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Approved
                        </span>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="{{ route('admin.articles.index') }}" class="text-[#0F766E] text-sm font-medium hover:text-[#0F766E]/80">
                        Lihat semua artikel →
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Quick Actions</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 gap-4">
                    <a href="{{ route('admin.articles.create') }}" 
                       class="flex items-center p-4 bg-[#0F766E] bg-opacity-5 rounded-lg hover:bg-opacity-10 transition-colors">
                        <div class="h-10 w-10 bg-[#0F766E] rounded-lg flex items-center justify-center mr-4">
                            <x-heroicon-s-plus class="h-5 w-5 text-white" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Tambah Artikel Baru</p>
                            <p class="text-sm text-gray-600">Buat artikel warisan budaya</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.fakta-cepat.create') }}" 
                       class="flex items-center p-4 bg-[#059669] bg-opacity-5 rounded-lg hover:bg-opacity-10 transition-colors">
                        <div class="h-10 w-10 bg-[#059669] rounded-lg flex items-center justify-center mr-4">
                            <x-heroicon-s-light-bulb class="h-5 w-5 text-white" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Tambah Fakta Cepat</p>
                            <p class="text-sm text-gray-600">Buat fakta cepat budaya</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.daily-missions.create') }}" 
                       class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                        <div class="h-10 w-10 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                            <x-heroicon-s-calendar-days class="h-5 w-5 text-white" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Buat Misi Harian</p>
                            <p class="text-sm text-gray-600">Setup misi untuk pengguna</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.categories.create') }}" 
                       class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                        <div class="h-10 w-10 bg-purple-600 rounded-lg flex items-center justify-center mr-4">
                            <x-heroicon-s-tag class="h-5 w-5 text-white" />
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Tambah Kategori</p>
                            <p class="text-sm text-gray-600">Kelola kategori warisan</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
