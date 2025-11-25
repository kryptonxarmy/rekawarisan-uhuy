@extends('admin.AdminLayout')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-[#0F766E]">Leaderboard</h1>
    <p class="text-gray-600 mt-2">Papan peringkat pengguna berdasarkan total XP</p>
</div>

<!-- Filters -->
<div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-8">
    <h3 class="text-lg font-semibold text-gray-900 mb-6">Filter Leaderboard</h3>
    
    <form method="GET" action="{{ route('admin.leaderboard.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Filter Type -->
        <div>
            <label for="filter" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
            <select name="filter" id="filter" 
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E] transition"
                onchange="toggleFilters()">
                <option value="global" {{ $filter === 'global' ? 'selected' : '' }}>Global</option>
                <option value="province" {{ $filter === 'province' ? 'selected' : '' }}>Per Provinsi</option>
                <option value="city" {{ $filter === 'city' ? 'selected' : '' }}>Per Kota</option>
            </select>
        </div>

        <!-- Province Filter -->
        <div id="province-filter" style="display: {{ in_array($filter, ['province', 'city']) ? 'block' : 'none' }};">
            <label for="province_name" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
            <select name="province_name" id="province_name" 
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E] transition"
                onchange="this.form.submit()">
                <option value="">Semua Provinsi</option>
                @foreach($provinces as $prov)
                    <option value="{{ $prov }}" {{ $provinceName == $prov ? 'selected' : '' }}>{{ $prov }}</option>
                @endforeach
            </select>
        </div>

        <!-- City Filter -->
        <div id="city-filter" style="display: {{ $filter === 'city' ? 'block' : 'none' }};">
            <label for="city_name" class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
            <select name="city_name" id="city_name" 
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E] transition"
                onchange="this.form.submit()">
                <option value="">Semua Kota</option>
                @foreach($cities as $city)
                    <option value="{{ $city }}" {{ $cityName == $city ? 'selected' : '' }}>{{ $city }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>

<!-- Leaderboard Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peringkat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total XP</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($leaderboard as $user)
                    <tr class="hover:bg-gray-50">
                        <!-- Rank -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                            @if($user->rank == 1)
                                <div class="flex items-center gap-2">
                                    <x-heroicon-s-trophy class="h-5 w-5 text-yellow-400" />
                                    #1
                                </div>
                            @elseif($user->rank == 2)
                                <div class="flex items-center gap-2">
                                    <x-heroicon-s-trophy class="h-5 w-5 text-gray-400" />
                                    #2
                                </div>
                            @elseif($user->rank == 3)
                                <div class="flex items-center gap-2">
                                    <x-heroicon-s-trophy class="h-5 w-5 text-orange-500" />
                                    #3
                                </div>
                            @elseif($user->rank <= 10)
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-blue-200 text-blue-800 text-xs font-semibold">
                                        {{$user->rank}}
                                    </span>
                                </div>
                            @else
                                #{{ $user->rank }}
                            @endif
                        </td>

                        <!-- User -->
                        <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                            <img class="h-10 w-10 rounded-full" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                            </div>
                        </td>

                        <!-- Location -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $user->regency }}, {{ $user->province }}
                        </td>

                        <!-- Level -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Level {{ $user->level }}
                            </span>
                        </td>

                        <!-- Total XP -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                            {{ number_format($user->total_points) }} XP
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            Belum ada data leaderboard.
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
</script>
@endsection
