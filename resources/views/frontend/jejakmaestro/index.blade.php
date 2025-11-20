@extends('frontend.layout.app', ['title' => 'Jejak Maestro'])

@section('content')
<section class="bg-gray-50 min-h-screen pb-16 relative overflow-x-hidden">

    {{-- ================= HERO SECTION ================= --}}
    <div 
        style="background-image: url('{{ asset('assets/landing/background-herosection.png') }}'); 
                background-size: cover; 
                background-repeat: no-repeat; 
                background-position: center; 
                background-blend-mode: overlay;">
        
        <div class="pt-24 pb-16 md:pt-32 md:pb-20 min-h-[30vh] md:min-h-[40vh] flex flex-col items-center justify-center relative z-10">
            <div class="container mx-auto px-6 text-center">
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl 
                        font-extrabold tracking-tight 
                        text-yellow-400 
                        drop-shadow-lg leading-tight md:leading-none">
                    Jejak Maestro
                </h1>

                
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 mt-10 grid grid-cols-6 gap-4">

        {{-- ================= CARD 1: WELCOME ================= --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-4 bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-2xl p-8 border border-[#389A92]/20 overflow-hidden relative group hover:shadow-2xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-[#389A92]/10 to-transparent rounded-full blur-xl"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-amber-400/10 to-transparent rounded-full blur-lg"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center relative z-10">
                <div class="md:col-span-2 space-y-6">
                    <div class="space-y-2">
                        <h2 class="text-4xl font-black text-[#145D63] leading-tight">
                            Halo, {{ Auth::user()->name ?? 'Pejuang Budaya' }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#389A92] to-amber-500">!</span>
                        </h2>
                        <div class="w-16 h-1.5 bg-gradient-to-r from-[#389A92] to-amber-400 rounded-full"></div>
                        <p class="text-gray-600 text-lg font-medium">Ayo, ukir jejak barumu hari ini! Misi harian menantimu.</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-gray-50 to-white p-6 rounded-2xl border border-gray-200/80 shadow-lg hover:shadow-xl transition-all duration-300 group-hover:border-[#389A92]/30">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#389A92] to-[#2D7A74] rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 text-lg mb-2">Raih Poin Maksimal Harian</h3>
                                <p class="text-gray-600 mb-4 leading-relaxed">Tuntaskan semua tugas harianmu dan buka Lencana Eksklusif.</p>
                                <button onclick="document.getElementById('misi-section').scrollIntoView({behavior: 'smooth'})" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#389A92] to-[#2D7A74] hover:from-[#2D7A74] hover:to-[#389A92] text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <span>Mulai Misi</span>
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="md:col-span-1 flex justify-center">
                    <div class="relative group/mascot">
                        <div class="absolute -inset-4 bg-gradient-to-r from-[#389A92] to-amber-400 rounded-full blur-lg opacity-30 group-hover/mascot:opacity-50 transition-all duration-500"></div>
                        <img src="{{ asset('assets/jejakmaestro/maskot-jejakmaestro.png') }}" alt="Mascot" class="w-full max-w-[250px] h-auto transform group-hover/mascot:scale-105 transition-transform duration-500 relative z-10">
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= CARD 2: INFO ================= --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-2 bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-2xl p-8 border border-[#389A92]/20 overflow-hidden relative group hover:shadow-2xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-bl from-amber-400/10 to-transparent rounded-full blur-lg"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 bg-gradient-to-tr from-[#389A92]/10 to-transparent rounded-full blur-md"></div>
            
            <div class="space-y-6 relative z-10">
                <div class="space-y-2">
                    <h2 class="text-3xl font-black text-[#145D63] leading-tight">
                        Capai Puncak Poin Harian <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-yellow-500">!</span>
                    </h2>
                    <div class="w-12 h-1 bg-gradient-to-r from-amber-400 to-yellow-400 rounded-full"></div>
                    <p class="text-gray-600 font-medium">Hadiah istimewa menanti! Semua misi di-reset secara otomatis setiap hari.</p>
                </div>
                
                <div class="bg-gradient-to-br from-amber-50 to-white p-6 rounded-2xl border border-amber-200/80 shadow-lg hover:shadow-xl transition-all duration-300 group-hover:border-amber-300/50">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-yellow-500 rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 mb-2">Tantangan Poin</h3>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">Selesaikan Misi Harian untuk Lencana dan Hadiah.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- ================= SECTION MISI HARIAN ================= --}}
        <div id="misi-section" class="col-span-6 md:col-span-3 lg:col-span-3 space-y-6">
            <h2 class="text-3xl font-black text-gray-900 border-b-2 border-gray-200 pb-2">Misi Harian</h2>
                
            @php
                // Skala 200 poin sesuai request badge (100, 150, 200)
                $progress = $dailyPoints > 0 ? ($dailyPoints / 200) * 100 : 0; 
                if ($progress > 100) $progress = 100;
            @endphp

            <div class="space-y-1">
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div class="h-3 rounded-full transition-all duration-1000 ease-out" 
                         style="width: {{ $progress }}%; background: linear-gradient(to right, #389A92 50%, #FFCC00 100%);"></div>
                </div>
                <div class="flex justify-between text-base font-bold text-gray-700">
                    <span class="text-lg font-extrabold text-[#389A92]">Point : {{ $dailyPoints }}</span>
                    <span class="text-gray-500">Target: 200</span>
                </div>
            </div>
            
            <div class="space-y-4">
                
                {{-- MISI 1: MEMBACA --}}
                <div class="flex items-center bg-white p-4 rounded-xl shadow-md transition hover:shadow-lg">
                    <img src="{{ asset('assets/logo-rekawarisan.png') }}" alt="Logo" class="w-12 mr-4">
                    <div class="flex-grow">
                        <p class="font-medium text-gray-900">Membaca Pustaka Warisan 1 Menit</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="8"></circle></svg>
                                <span class="text-xs text-amber-600 font-bold">+10 Poin</span>
                            </div>

                            @if ($dailyMission->read_done)
                                <p class="text-sm font-semibold text-green-600 mb-1">Misi Selesai</p>
                            @else
                                <form method="POST" action="{{ route('mission.complete.read') }}">
                                    @csrf
                                    <button type="submit" class="text-sm font-semibold text-blue-600 hover:text-blue-800 underline">Tandai Selesai</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="text-right ml-2">
                        @if ($dailyMission->read_done)
                            <img src="{{ asset('assets/jejakmaestro/misi/logo-misi-done.png') }}" alt="Done" class="w-16">
                        @else
                            <img src="{{ asset('assets/jejakmaestro/misi/logo-misi-not-done.png') }}" alt="Not Done" class="w-16">
                        @endif
                    </div>
                </div>

                {{-- MISI 2: KUIS --}}
                <div @if(!$dailyMission->quiz_done) id="open-quiz-modal" @endif 
                     class="flex items-center bg-white p-4 rounded-xl border border-gray-300 shadow-md transition duration-300 {{ !$dailyMission->quiz_done ? 'cursor-pointer hover:shadow-lg hover:border-amber-300' : '' }}">
                    
                    <img src="{{ asset('assets/logo-rekawarisan.png') }}" alt="Logo" class="w-12 mr-4">
                    <div class="flex-grow">
                        <p class="font-medium text-gray-900">Pertanyaan Kuis</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="8"></circle></svg>
                                <span class="text-xs text-amber-600 font-bold">+40 Poin</span>
                            </div>
                            
                            @if ($dailyMission->quiz_done)
                                <p class="text-sm font-semibold text-green-600 mb-1">Misi Selesai</p>
                            @else
                                <p class="text-sm font-semibold text-red-500 mb-1 animate-pulse">Kerjakan Kuis</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-right ml-2">
                        @if ($dailyMission->quiz_done)
                            <img src="{{ asset('assets/jejakmaestro/misi/logo-misi-done.png') }}" alt="Done" class="w-16">
                        @else
                            <img src="{{ asset('assets/jejakmaestro/misi/logo-misi-not-done.png') }}" alt="Not Done" class="w-16">
                        @endif
                    </div>
                </div>

                {{-- MISI 3: SHARE (BONUS) - TERBUKA JIKA MISI 1 & 2 SELESAI --}}
                @if ($dailyMission->read_done && $dailyMission->quiz_done)
                    {{-- STATE: TERBUKA (AKTIF) --}}
                    <div class="flex items-center bg-white p-4 rounded-xl shadow-md transition hover:shadow-lg border-2 border-amber-200">
                        <img src="{{ asset('assets/logo-rekawarisan.png') }}" alt="Logo" class="w-12 mr-4">
                        <div class="flex-grow">
                            <p class="font-medium text-gray-900">Bagikan Budaya ke Teman</p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="8"></circle></svg>
                                    <span class="text-xs text-amber-600 font-bold">+100 Poin</span>
                                </div>
                                
                                {{-- LOGIC BUTTON SHARE (+100 POIN) --}}
                                @if($dailyMission->share_done)
                                    <p class="text-sm font-semibold text-green-600 mb-1">Misi Selesai</p>
                                @else
                                    <form method="POST" action="{{ route('mission.complete.share') }}">
                                        @csrf
                                        <button type="submit" class="text-sm font-semibold text-blue-600 hover:text-blue-800 underline">Bagikan Sekarang</button>
                                    </form>
                                @endif

                            </div>
                        </div>
                        <div class="text-right ml-2">
                            @if($dailyMission->share_done)
                                <img src="{{ asset('assets/jejakmaestro/misi/logo-misi-done.png') }}" alt="Done" class="w-16">
                            @else
                                <img src="{{ asset('assets/jejakmaestro/misi/logo-misi-not-done.png') }}" alt="Not Done" class="w-16">
                            @endif
                        </div>
                    </div>
                @else
                    {{-- STATE: TERKUNCI (LOCKED) --}}
                    <div class="bg-gray-100 p-4 rounded-xl flex items-center justify-center space-x-3 shadow-inner border border-gray-200 opacity-75 cursor-not-allowed">
                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <div class="text-left">
                            <p class="text-gray-600 font-bold">Misi Ini Belum Terbuka</p>
                            <p class="text-xs text-gray-500">Selesaikan misi membaca & kuis dulu.</p>
                        </div>
                    </div>
                @endif

            </div>

            {{-- BADGE SECTION --}}
            <div class="space-y-4 pt-4 border-t border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Koleksi Badge Anda :</h2>
                <div class="flex flex-wrap gap-4 justify-start items-center min-h-[100px]">
                    
                    {{-- Loop Badge User --}}
@forelse ($user->badges ?? [] as $badge)
    <div class="flex flex-col items-center animate-fade-in-up">
        {{-- PERBAIKAN DI SINI: Hapus string path manual, gunakan langsung dari DB --}}
        <img src="{{ asset($badge->image) }}" 
             alt="{{ $badge->name }}" 
             class="w-20 h-20 rounded-full shadow-lg border-2 border-yellow-500 hover:scale-110 transition-transform cursor-pointer"
             title="{{ $badge->name }}">
             
        <span class="text-xs font-bold text-gray-600 mt-1">{{ $badge->name }}</span>
    </div>
@empty
    {{-- Bagian empty tetap sama --}}
    <div class="flex items-center text-gray-500 italic bg-gray-100 px-4 py-2 rounded-lg w-full">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        Belum memiliki badge. Selesaikan misi untuk raih 100, 150, & 200 Poin!
    </div>
@endforelse

                </div>
            </div>
        </div>

        {{-- ================= GAMBAR BAPAK ================= --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-1 flex justify-center items-center">
            <img src="{{ asset('assets/jejakmaestro/bapakbapak.png') }}" alt="Bapak Maestro" class="max-w-full h-auto drop-shadow-xl">
        </div>

        {{-- ================= LEADERBOARD ================= --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-3xl shadow-2xl border border-gray-200 space-y-4 h-full">
                <h2 class="text-2xl font-extrabold text-[#145D63] text-center">Leaderboard Poin</h2>
                
                <div class="flex rounded-xl overflow-hidden shadow-lg bg-gray-100 p-1">
                    <button id="tab-kota" onclick="showLeaderboard('kota')" class="tab-button flex-1 py-2 text-sm font-bold text-gray-700 hover:bg-gray-200 transition rounded-lg">Kota</button>
                    <button id="tab-provinsi" onclick="showLeaderboard('provinsi')" class="tab-button flex-1 py-2 text-sm font-bold text-gray-700 hover:bg-gray-200 transition rounded-lg">Provinsi</button>
                    <button id="tab-indonesia" onclick="showLeaderboard('indonesia')" class="tab-button flex-1 py-2 text-sm font-bold bg-[#389A92] text-white shadow-md rounded-lg">Indonesia</button>
                </div>

                <div class="overflow-x-auto h-[400px] relative custom-scrollbar">
                    {{-- TABLE INDONESIA --}}
                    <div id="leaderboard-indonesia" class="leaderboard-content absolute inset-0 transition-opacity duration-300">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead class="sticky top-0 bg-white z-10">
                                <tr class="text-xs uppercase font-bold text-[#2D7A74] border-b-2 border-gray-300">
                                    <th class="py-2 px-2">No</th>
                                    <th class="py-2 px-2">Nama</th>
                                    <th class="py-2 px-2 text-right">Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaderboardIndonesia as $i => $userRow)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition {{ $i == 0 ? 'bg-yellow-50 font-bold' : '' }}">
                                    <td class="py-2 px-2">{{ $i + 1 }}</td>
                                    <td class="py-2 px-2">{{ $userRow->name }}</td>
                                    <td class="py-2 px-2 text-right {{ $i == 0 ? 'text-amber-600' : '' }}">{{ $userRow->points }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- TABLE PROVINSI --}}
                    <div id="leaderboard-provinsi" class="leaderboard-content absolute inset-0 transition-opacity duration-300 hidden">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead class="sticky top-0 bg-white z-10">
                                <tr class="text-xs uppercase font-bold text-[#2D7A74] border-b-2 border-gray-300">
                                    <th class="py-2 px-2">No</th>
                                    <th class="py-2 px-2">Nama</th>
                                    <th class="py-2 px-2 text-right">Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaderboardProvinsi as $i => $userRow)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition {{ $i == 0 ? 'bg-green-50 font-bold' : '' }}">
                                    <td class="py-2 px-2">{{ $i + 1 }}</td>
                                    <td class="py-2 px-2">
                                        {{ $userRow->name }}
                                        <div class="text-[10px] text-gray-400">{{ $userRow->province ?? '-' }}</div>
                                    </td>
                                    <td class="py-2 px-2 text-right {{ $i == 0 ? 'text-green-600' : '' }}">{{ $userRow->points }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- TABLE KOTA --}}
                    <div id="leaderboard-kota" class="leaderboard-content absolute inset-0 transition-opacity duration-300 hidden">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead class="sticky top-0 bg-white z-10">
                                <tr class="text-xs uppercase font-bold text-[#2D7A74] border-b-2 border-gray-300">
                                    <th class="py-2 px-2">No</th>
                                    <th class="py-2 px-2">Nama</th>
                                    <th class="py-2 px-2 text-right">Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaderboardKota as $i => $userRow)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition {{ $i == 0 ? 'bg-blue-50 font-bold' : '' }}">
                                    <td class="py-2 px-2">{{ $i + 1 }}</td>
                                    <td class="py-2 px-2">
                                        {{ $userRow->name }}
                                        <div class="text-[10px] text-gray-400">{{ $userRow->regency ?? '-' }}</div>
                                    </td>
                                    <td class="py-2 px-2 text-right {{ $i == 0 ? 'text-blue-600' : '' }}">{{ $userRow->points }}</td>
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

{{-- ================= MODAL KUIS ================= --}}
<div id="quiz-modal" class="fixed inset-0 z-50 hidden bg-gray-900/60 backdrop-blur-sm flex items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 relative">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2"><span class="text-amber-500">✦</span> Uji Pemahaman Budaya</h3>
            <button id="close-quiz-modal" class="text-gray-400 hover:text-red-500 focus:outline-none"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        <form action="{{ route('mission.complete.quiz') }}" method="POST">
            @csrf
            <div class="mb-6">
                <p class="font-semibold text-gray-700 mb-3 text-lg">1. Apa budaya asli Jawa yang diakui UNESCO?</p>
                <div class="space-y-3">
                    <label class="flex items-center bg-gray-50 p-3 rounded-lg hover:bg-amber-50 cursor-pointer transition"><input type="radio" name="jawaban_soal_1" value="wayang" class="form-radio text-amber-500"><span class="ml-3 text-gray-700">Wayang Kulit</span></label>
                    <label class="flex items-center bg-gray-50 p-3 rounded-lg hover:bg-amber-50 cursor-pointer transition"><input type="radio" name="jawaban_soal_1" value="reog" class="form-radio text-amber-500"><span class="ml-3 text-gray-700">Reog Ponorogo</span></label>
                </div>
            </div>
            <div class="pt-4 border-t flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-amber-500 to-yellow-500 text-white font-bold py-2.5 px-6 rounded-lg shadow-lg">Kirim Jawaban</button>
            </div>
        </form>
    </div>
</div>

{{-- ================= MODAL REWARD BADGE BARU ================= --}}
@if(session('badge_awarded'))
<div id="reward-modal" class="fixed inset-0 z-[99] flex items-center justify-center bg-black/70 backdrop-blur-sm animate-fade-in">
    <div class="bg-white rounded-3xl shadow-2xl p-8 text-center max-w-md w-full relative transform transition-all animate-bounce-in border-4 border-[#389A92]">
        <div class="absolute inset-0 overflow-hidden rounded-3xl pointer-events-none">
             <div class="absolute top-0 left-0 w-full h-full opacity-20" style="background-image: radial-gradient(#FFD700 2px, transparent 2px); background-size: 30px 30px;"></div>
        </div>
        <button onclick="document.getElementById('reward-modal').remove()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h2 class="text-3xl font-black text-amber-500 mb-2 uppercase tracking-widest">Selamat!</h2>
        <p class="text-gray-600 font-medium mb-6">Anda mendapatkan Badge Baru!</p>
        <div class="flex justify-center mb-6 relative">
            <div class="absolute inset-0 bg-yellow-400 rounded-full blur-xl opacity-50 animate-pulse"></div>
            <img src="{{ asset('assets/jejakmaestro/badge/' . session('badge_awarded')['image']) }}" 
                 alt="New Badge" 
                 class="w-40 h-40 relative z-10 drop-shadow-2xl animate-spin-slow-once">
        </div>
        <h3 class="text-2xl font-bold text-[#145D63] mb-2">{{ session('badge_awarded')['name'] }}</h3>
        <p class="text-sm text-gray-500 mb-6">Terus kumpulkan poin untuk melengkapi koleksi maestro Anda.</p>
        <button onclick="document.getElementById('reward-modal').remove()" class="w-full bg-gradient-to-r from-[#389A92] to-[#2D7A74] text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition transform">
            Klaim Badge & Lanjut
        </button>
    </div>
</div>
@endif

<script>
    function showLeaderboard(activeTabId) {
        document.querySelectorAll('.leaderboard-content').forEach(c => {
            c.classList.add('hidden');
            c.classList.remove('animate-fade-in');
        });
        const activeContent = document.getElementById('leaderboard-' + activeTabId);
        if(activeContent) {
            activeContent.classList.remove('hidden');
            activeContent.classList.add('animate-fade-in');
        }
        document.querySelectorAll('.tab-button').forEach(t => {
            t.classList.remove('bg-[#389A92]', 'text-white', 'shadow-md');
            t.classList.add('text-gray-700', 'hover:bg-gray-200');
        });
        const activeTab = document.getElementById('tab-' + activeTabId);
        if (activeTab) {
            activeTab.classList.remove('text-gray-700', 'hover:bg-gray-200');
            activeTab.classList.add('bg-[#389A92]', 'text-white', 'shadow-md');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        showLeaderboard('indonesia'); 
        const openModalBtn = document.getElementById('open-quiz-modal');
        const closeModalBtn = document.getElementById('close-quiz-modal');
        const modal = document.getElementById('quiz-modal');

        if (openModalBtn) openModalBtn.addEventListener('click', () => modal.classList.remove('hidden'));
        if (closeModalBtn) closeModalBtn.addEventListener('click', () => modal.classList.add('hidden'));
        if(modal) modal.addEventListener('click', (e) => { if (e.target === modal) modal.classList.add('hidden'); });
    });
</script>

<style>
    @keyframes bounceIn {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.05); opacity: 1; }
        70% { transform: scale(0.9); }
        100% { transform: scale(1); }
    }
    .animate-bounce-in {
        animation: bounceIn 0.8s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;
    }
    @keyframes spinSlowOnce {
        from { transform: rotate(-180deg) scale(0.5); }
        to { transform: rotate(0deg) scale(1); }
    }
    .animate-spin-slow-once {
        animation: spinSlowOnce 1s ease-out forwards;
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }
</style>

@endsection