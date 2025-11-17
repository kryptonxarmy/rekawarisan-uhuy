@extends('frontend.layout.app', ['title' => 'Jejak Maestro'])
@section('content')

<section class="bg-gray-50 min-h-screen pb-16">

    {{-- HERO ... same as your design (kept) --}}
    <div class="rounded-xl min-h-[35vh] flex flex-col items-center justify-center text-center px-6 pt-20 mt-[-5rem]"
         style="background-image: url('{{ asset('assets/landing/background-herosection.png') }}'); background-size: cover;">
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-6xl font-black tracking-tight text-yellow-400 leading-none">Jejak Maestro</h1>
        </div>
    </div>

    <div class="container mx-auto px-6 mt-10 grid grid-cols-6 gap-4">
        {{-- left cards (kept as-is) --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-4 ...">
            {{-- ... your left content (unchanged) --}}
        </div>

        {{-- challenges card (kept) --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-2 ...">
            {{-- ... your challenges content --}}
        </div>

        {{-- ====================== MISI HARIAN ======================= --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-3 space-y-6">

            <h2 class="text-3xl font-black text-gray-900 border-b-2 border-gray-200 pb-2">Misi Harian</h2>

            @php
                // dailyPoints already passed from controller
                $progress = $dailyPoints > 0 ? ($dailyPoints / 100) * 100 : 0;
                if ($progress > 100) $progress = 100;
            @endphp

            <div class="space-y-1">
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="h-3 rounded-full" style="width: {{ $progress }}%; background: linear-gradient(to right, #389A92, #FFCC00);"></div>
                </div>

                <div class="flex justify-between font-bold text-gray-700">
                    <span class="text-lg font-extrabold text-[#389A92]">Point : {{ $dailyPoints }}</span>
                    <span class="text-gray-500">100</span>
                </div>
            </div>

            <div class="space-y-4">
                {{-- MISI 1: Membaca --}}
                <div class="flex items-center bg-white p-4 rounded-xl shadow-md">
                    <img src="{{ asset('assets/logo-rekawarisan.png') }}" class="w-12 mr-4" alt="">
                    <div class="flex-grow">
                        <p class="font-medium text-gray-900">Membaca Pustaka Warisan 1 Menit</p>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="8"></circle>
                                </svg>
                                <span class="text-xs text-amber-600 font-bold">10</span>
                            </div>

                            @if ($dailyMission->read_done)
                                <p class="text-sm font-semibold text-green-600">Misi Selesai</p>
                            @else
                                <form method="POST" action="{{ route('mission.complete.read') }}">
                                    @csrf
                                    <button type="submit" class="text-sm font-semibold text-blue-600">Tandai Selesai</button>
                                </form>
                            @endif
                        </div>
                    </div>

                    @if ($dailyMission->read_done)
                        <img src="{{ asset('assets/jejakmaestro/misi/logo-misi-done.png') }}" class="w-18" alt="">
                    @else
                        <img src="{{ asset('assets/jejakmaestro/misi/logo-misi-not-done.png') }}" class="w-18" alt="">
                    @endif
                </div>

                {{-- MISI 2: Quiz --}}
                <div class="flex items-center bg-white p-4 rounded-xl border border-gray-300 shadow-md">
                    <img src="{{ asset('assets/logo-rekawarisan.png') }}" class="w-12 mr-4" alt="">
                    <div class="flex-grow">
                        <p class="font-medium text-gray-900">Pertanyaan Kuiz</p>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="8"></circle>
                                </svg>
                                <span class="text-xs text-amber-600 font-bold">40</span>
                            </div>

                            @if ($dailyMission->quiz_done)
                                <p class="text-sm font-semibold text-green-600">Misi Selesai</p>
                            @else
                                <form method="POST" action="{{ route('mission.complete.quiz') }}">
                                    @csrf
                                    <button type="submit" class="text-sm font-semibold text-blue-600">Tandai Selesai</button>
                                </form>
                            @endif
                        </div>
                    </div>

                    @if ($dailyMission->quiz_done)
                        <img src="{{ asset('assets/jejakmaestro/misi/logo-misi-done.png') }}" class="w-18" alt="">
                    @else
                        <img src="{{ asset('assets/jejakmaestro/misi/logo-misi-not-done.png') }}" class="w-18" alt="">
                    @endif
                </div>

                {{-- MISI LOCKED --}}
                <div class="bg-gray-800 p-4 rounded-xl flex items-center justify-center space-x-3">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <p class="text-gray-400 font-medium">Misi Ini Belum Tersedia</p>
                </div>
            </div>

            {{-- BADGE --}}
            <div class="space-y-4 pt-4 border-t border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Badge :</h2>

                <div class="flex flex-wrap gap-4">
                    @if ($user->badge)
                        {{-- Use badge name to pick image file (lowercase) --}}
                        <img src="{{ asset('assets/jejakmaestro/badge/' . strtolower($user->badge->name) . '.png') }}"
                             class="w-20 h-20 rounded-full shadow-lg" alt="{{ $user->badge->name }}">
                    @else
                        <p class="text-gray-500">Belum memiliki badge</p>
                    @endif
                </div>
            </div>

        </div>

        {{-- FOTO BAPAK (kept) --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-1 flex justify-center items-center">
            <img src="{{ asset('assets/jejakmaestro/bapakbapak.png') }}" class="max-w-full h-auto" alt="">
        </div>

        {{-- LEADERBOARD (kept, dinamis) --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-2 space-y-6">
            {{-- ... your leaderboard HTML (kept) --}}
            <div class="bg-white p-6 rounded-3xl shadow-2xl border border-gray-200 space-y-4">
                <h2 class="text-2xl font-extrabold text-[#145D63] text-center">Leaderboard Poin</h2>
                <div class="flex rounded-xl overflow-hidden shadow-lg bg-gray-100 p-1">
                    <button id="tab-kota" onclick="showLeaderboard('kota')" class="tab-button flex-1 py-2 text-sm font-bold text-gray-700 hover:bg-gray-200">Kota</button>
                    <button id="tab-provinsi" onclick="showLeaderboard('provinsi')" class="tab-button flex-1 py-2 text-sm font-bold text-gray-700 hover:bg-gray-200">Provinsi</button>
                    <button id="tab-indonesia" onclick="showLeaderboard('indonesia')" class="tab-button flex-1 py-2 text-sm font-bold bg-[#389A92] text-white shadow-md">Indonesia</button>
                </div>

                <div class="overflow-x-auto h-[400px] relative">
                    {{-- Indonesia table --}}
                    <div id="leaderboard-indonesia" class="leaderboard-content absolute inset-0">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead>
                                <tr class="text-xs uppercase font-bold text-[#2D7A74] border-b-2 border-gray-300">
                                    <th class="py-2 px-2">No</th>
                                    <th class="py-2 px-2">Nama</th>
                                    <th class="py-2 px-2 text-right">Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaderboardIndonesia as $i => $userRow)
                                <tr class="border-b {{ $i == 0 ? 'bg-yellow-50 font-bold' : '' }}">
                                    <td class="py-2 px-2">{{ $i + 1 }}</td>
                                    <td class="py-2 px-2">{{ $userRow->name }}</td>
                                    <td class="py-2 px-2 text-right {{ $i == 0 ? 'text-amber-600 font-bold' : '' }}">
                                        {{ $userRow->points }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Provinsi --}}
                    <div id="leaderboard-provinsi" class="leaderboard-content absolute inset-0 hidden">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead>
                                <tr class="text-xs uppercase font-bold text-[#2D7A74] border-b-2 border-gray-300">
                                    <th class="py-2 px-2">No</th>
                                    <th class="py-2 px-2">Nama</th>
                                    <th class="py-2 px-2 text-right">Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaderboardProvinsi as $i => $userRow)
                                <tr class="border-b {{ $i == 0 ? 'bg-green-50 font-bold' : '' }}">
                                    <td class="py-2 px-2">{{ $i + 1 }}</td>
                                    <td class="py-2 px-2">{{ $userRow->name }} <span class="text-xs text-gray-500">({{ $userRow->province }})</span></td>
                                    <td class="py-2 px-2 text-right {{ $i == 0 ? 'text-green-600 font-bold' : '' }}">{{ $userRow->points }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Kota --}}
                    <div id="leaderboard-kota" class="leaderboard-content absolute inset-0 hidden">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead>
                                <tr class="text-xs uppercase font-bold text-[#2D7A74] border-b-2 border-gray-300">
                                    <th class="py-2 px-2">No</th>
                                    <th class="py-2 px-2">Nama</th>
                                    <th class="py-2 px-2 text-right">Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaderboardKota as $i => $userRow)
                                <tr class="border-b {{ $i == 0 ? 'bg-blue-50 font-bold' : '' }}">
                                    <td class="py-2 px-2">{{ $i + 1 }}</td>
                                    <td class="py-2 px-2">{{ $userRow->name }} <span class="text-xs text-gray-500">({{ $userRow->regency }})</span></td>
                                    <td class="py-2 px-2 text-right {{ $i == 0 ? 'text-blue-600 font-bold' : '' }}">{{ $userRow->points }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>

</section>

{{-- SCRIPT (kept) --}}
<script>
    function showLeaderboard(activeTabId) {
        document.querySelectorAll('.leaderboard-content').forEach(c => c.classList.add('hidden'));
        document.getElementById('leaderboard-' + activeTabId).classList.remove('hidden');

        document.querySelectorAll('.tab-button').forEach(t => {
            t.classList.remove('bg-[#389A92]', 'text-white', 'shadow-md');
            t.classList.add('text-gray-700');
        });

        const activeTab = document.getElementById('tab-' + activeTabId);
        if (activeTab) activeTab.classList.add('bg-[#389A92]', 'text-white', 'shadow-md');
    }

    document.addEventListener('DOMContentLoaded', () => showLeaderboard('indonesia'));
</script>

@endsection
