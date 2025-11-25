@extends('admin.AdminLayout')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#0F766E]">Leaderboard</h1>
        <p class="text-gray-600 mt-2">Papan peringkat pengguna berdasarkan prestasi dan kontribusi</p>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Leaderboard</h3>
        
        <form method="GET" action="{{ route('admin.leaderboard.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Filter Type -->
            <div>
                <label for="filter" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="filter" id="filter" class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]"
                    onchange="toggleFilters()">
                    <option value="global" {{ $filter === 'global' ? 'selected' : '' }}>Global</option>
                    <option value="province" {{ $filter === 'province' ? 'selected' : '' }}>Per Provinsi</option>
                    <option value="city" {{ $filter === 'city' ? 'selected' : '' }}>Per Kota</option>
                </select>
            </div>

            <!-- Province Filter -->
            <div id="province-filter" style="display: {{ in_array($filter, ['province', 'city']) ? 'block' : 'none' }};">
                <label for="province_id" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                <select name="province_id" id="province_id" class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]"
                    onchange="updateCities()">
                    <option value="">Pilih Provinsi</option>
                    @foreach($provinces as $province)
                        <option value="{{ $province->id }}" {{ $provinceId == $province->id ? 'selected' : '' }}>
                            {{ $province->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- City Filter -->
            <div id="city-filter" style="display: {{ $filter === 'city' ? 'block' : 'none' }};">
                <label for="city_id" class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                <select name="city_id" id="city_id" class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]">
                    <option value="">Pilih Kota</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {{ $cityId == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex items-end">
                <button type="submit" class="bg-[#0F766E] text-white px-6 py-2 rounded-lg hover:bg-[#0F766E]/90 w-full">
                    Filter
                </button>
            </div>
        </form>

        <!-- Current Filter Display -->
        @if($filter !== 'global')
            <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                <div class="flex items-center text-blue-800">
                    <x-heroicon-s-funnel class="h-5 w-5 mr-2" />
                    <span class="text-sm font-medium">
                        Filter aktif: 
                        @if($filter === 'province' && $selectedProvince)
                            Provinsi {{ $selectedProvince->name }}
                        @elseif($filter === 'city' && $selectedCity)
                            {{ $selectedCity->name }}, {{ $selectedProvince->name }}
                        @endif
                    </span>
                </div>
            </div>
        @endif
    </div>

    <!-- Leaderboard Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Peringkat
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pengguna
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lokasi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Level
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total XP
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Misi Selesai
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Badge
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Streak
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($leaderboard as $user)
                        <tr class="hover:bg-gray-50">
                            <!-- Rank -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($user->rank <= 3)
                                        <div class="h-10 w-10 rounded-full flex items-center justify-center
                                            {{ $user->rank == 1 ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $user->rank == 2 ? 'bg-gray-100 text-gray-600' : '' }}
                                            {{ $user->rank == 3 ? 'bg-orange-100 text-orange-600' : '' }}">
                                            @if($user->rank == 1)
                                                <x-heroicon-s-trophy class="h-6 w-6" />
                                            @elseif($user->rank == 2) 
                                                <x-heroicon-s-star class="h-6 w-6" />
                                            @else
                                                <x-heroicon-s-gift class="h-6 w-6" />
                                            @endif
                                        </div>
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                            <span class="text-sm font-semibold text-gray-600">#{{ $user->rank }}</span>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <!-- User -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Location -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->city }}</div>
                                <div class="text-sm text-gray-500">{{ $user->province }}</div>
                            </td>

                            <!-- Level -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#0F766E] text-white">
                                        Level {{ $user->level }}
                                    </span>
                                </div>
                            </td>

                            <!-- XP -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                {{ number_format($user->total_xp) }} XP
                            </td>

                            <!-- Missions -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->missions_completed }}
                            </td>

                            <!-- Badges -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    {{ $user->badges_count }} Badge
                                </span>
                            </td>

                            <!-- Streak -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <x-heroicon-s-fire class="h-4 w-4 text-orange-500 mr-1" />
                                    <span class="text-sm text-gray-900">{{ $user->streak_days }} hari</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <x-heroicon-o-user-group class="h-12 w-12 text-gray-400 mb-4" />
                                    <p class="text-lg font-medium">Belum ada data</p>
                                    <p class="text-sm">Tidak ada pengguna yang ditemukan untuk filter yang dipilih.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleFilters() {
            const filterValue = document.getElementById('filter').value;
            const provinceFilter = document.getElementById('province-filter');
            const cityFilter = document.getElementById('city-filter');
            
            if (filterValue === 'global') {
                provinceFilter.style.display = 'none';
                cityFilter.style.display = 'none';
            } else if (filterValue === 'province') {
                provinceFilter.style.display = 'block';
                cityFilter.style.display = 'none';
            } else if (filterValue === 'city') {
                provinceFilter.style.display = 'block';
                cityFilter.style.display = 'block';
            }
        }

        function updateCities() {
            // Placeholder for dynamic city loading based on province
            // In real implementation, this would make an AJAX call
        }
    </script>
@endsection
