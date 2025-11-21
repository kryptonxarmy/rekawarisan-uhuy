@extends('frontend.layout.app', ['title' => 'Jejak Maestro'])

@section('content')
<section class="bg-gray-50 min-h-screen pb-16">

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

        {{-- ================= CARD 1: WELCOME GUEST (Kiri Atas) ================= --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-4 bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-2xl p-8 border border-[#389A92]/20 overflow-hidden relative group hover:shadow-2xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-[#389A92]/10 to-transparent rounded-full blur-xl"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-amber-400/10 to-transparent rounded-full blur-lg"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center relative z-10">
                <div class="md:col-span-2 space-y-6">
                    <div class="space-y-2">
                        <h2 class="text-4xl font-black text-[#145D63] leading-tight">
                            Halo, Calon Maestro <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#389A92] to-amber-500">!</span>
                        </h2>
                        <div class="w-16 h-1.5 bg-gradient-to-r from-[#389A92] to-amber-400 rounded-full"></div>
                        <p class="text-gray-600 text-lg font-medium">Bergabunglah sekarang untuk mengukir jejak budaya dan raih hadiah menarik!</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-gray-50 to-white p-6 rounded-2xl border border-gray-200/80 shadow-lg hover:shadow-xl transition-all duration-300 group-hover:border-[#389A92]/30">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#389A92] to-[#2D7A74] rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 text-lg mb-2">Login untuk Mulai</h3>
                                <p class="text-gray-600 mb-4 leading-relaxed">Masuk ke akunmu untuk mengakses Misi Harian, Kuis, dan Leaderboard.</p>
                                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#389A92] to-[#2D7A74] hover:from-[#2D7A74] hover:to-[#389A92] text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <span>Masuk Sekarang</span>
                                </a>
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

        {{-- ================= CARD 2: INFO (Kanan Atas) ================= --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-2 bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-2xl p-8 border border-[#389A92]/20 overflow-hidden relative group hover:shadow-2xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-bl from-amber-400/10 to-transparent rounded-full blur-lg"></div>
            <div class="absolute bottom-0 left-0 w-16 h-16 bg-gradient-to-tr from-[#389A92]/10 to-transparent rounded-full blur-md"></div>
            
            <div class="space-y-6 relative">
                <div class="space-y-2">
                    <h2 class="text-3xl font-black text-[#145D63] leading-tight">
                        Hadiah Menanti Anda <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-yellow-500">!</span>
                    </h2>
                    <div class="w-12 h-1 bg-gradient-to-r from-amber-400 to-yellow-400 rounded-full"></div>
                    <p class="text-gray-600 font-medium">Kumpulkan poin sebanyak-banyaknya dan menangkan Badge Eksklusif.</p>
                </div>
                
                <div class="bg-gradient-to-br from-amber-50 to-white p-6 rounded-2xl border border-amber-200/80 shadow-lg hover:shadow-xl transition-all duration-300 group-hover:border-amber-300/50">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-yellow-500 rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 mb-2">Akses Terkunci</h3>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">Fitur tantangan harian hanya tersedia untuk member terdaftar.</p>
                            <a href="{{ route('login') }}" class="text-amber-600 font-bold text-sm hover:underline">Login untuk membuka &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- ================= KOLOM MISI HARIAN & FEATURE CARDS ================= --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-3 space-y-6 z-10">
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                {{-- Card 1: Baca Artikel (Warna Aksen: Indigo) --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 text-center 
                            transform transition-all duration-300 hover:scale-[1.03] hover:shadow-2xl hover:border-indigo-300">
                    
                    <div class="flex justify-center mb-3">
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.429 9.832 5 8 5c-3.866 0-7 3.344-7 7s3.134 7 7 7c1.832 0 2.832-.429 4-1.253m0-13C13.168 5.429 14.168 5 16 5c3.866 0 7 3.344 7 7s-3.134 7-7 7c-1.832 0-2.832-.429-4-1.253"></path>
                        </svg>
                    </div>
                    
                    <h3 class="font-extrabold text-xl text-indigo-700 mb-1">Baca Artikel</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Pelajari budaya Nusantara melalui artikel mendalam</p>
                </div>

                {{-- Card 2: Selesaikan Kuis (Warna Aksen: Teal) --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 text-center 
                            transform transition-all duration-300 hover:scale-[1.03] hover:shadow-2xl hover:border-teal-300">
                    
                    <div class="flex justify-center mb-3">
                        <svg class="w-8 h-8 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.691 5.176-1.4 9-6.1 9-11.691 0-1.015-.177-2.008-.507-2.944z"></path>
                        </svg>
                    </div>
                    
                    <h3 class="font-extrabold text-xl text-teal-700 mb-1">Selesaikan Kuis</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Uji pengetahuan dengan kuis interaktif harian</p>
                </div>

                {{-- Card 3: Dapatkan Badge (Warna Aksen: Amber) --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 text-center 
                            transform transition-all duration-300 hover:scale-[1.03] hover:shadow-2xl hover:border-amber-300">
                    
                    <div class="flex justify-center mb-3">
                        <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.152C11.385 1.761 12.015 1.761 12.351 2.152L15.659 6.01L20.444 6.377C20.89 6.41 21.056 7.017 20.738 7.31L17.078 10.749L18.17 15.424C18.27 15.86 17.828 16.208 17.437 16.007L12 13.56L6.563 16.007C6.172 16.208 5.73 15.86 5.83 15.424L6.922 10.749L3.262 7.31C2.944 7.017 3.11 6.41 3.556 6.377L8.341 6.01L11.649 2.152z"></path>
                        </svg>
                    </div>
                    
                    <h3 class="font-extrabold text-xl text-amber-700 mb-1">Dapatkan Badge</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Koleksi badge eksklusif dari pencapaian Anda</p>
                </div>
            </div>

            {{-- SECTION MISI HARIAN (LOCKED) --}}
            <div class="relative rounded-3xl overflow-hidden min-h-[400px]">
                
                {{-- OVERLAY CARD LOGIN (Style Gambar 2) --}}
                <div class="absolute inset-0 z-10 bg-gray-100/40 backdrop-blur-[3px] flex items-center justify-center p-4">
                    <div class="bg-white rounded-2xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.3)] p-8 w-full max-w-xs text-center border border-gray-100 transform transition hover:scale-105 duration-300">
                        
                        {{-- Gembok Icon Simple --}}
                        <div class="flex justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="5" y="11" width="14" height="10" rx="2" ry="2" stroke-width="2"></rect>
                                <path d="M8 11V7a4 4 0 018 0v4" stroke-width="2" stroke-linecap="round"></path>
                                <circle cx="12" cy="16" r="1" fill="currentColor"></circle>
                            </svg>
                        </div>

                        <h3 class="text-lg font-extrabold text-gray-800 mb-2">Kumpulkan Poin</h3>
                        <p class="text-xs text-gray-500 mb-6 leading-relaxed">Selesaikan misi harian untuk mendapatkan poin dan badge eksklusif!</p>
                        
                        <a href="{{ route('login') }}" class="block w-full bg-[#389A92] hover:bg-[#2D7A74] text-white font-bold py-2.5 rounded-lg shadow-md transition text-sm">
                            Masuk untuk Memulai
                        </a>
                    </div>
                </div>

                {{-- KONTEN DUMMY DI BALIK LAYAR --}}
                <div class="p-4 sm:p-6 opacity-40 filter blur-[1px]">
                    <h2 class="text-3xl font-black text-gray-900 border-b-2 border-gray-200 pb-2">Misi Harian</h2>
                    
                    <div class="space-y-1 mt-4">
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="h-3 rounded-full bg-gray-300" style="width: 0%;"></div>
                        </div>
                        <div class="flex justify-between text-base font-bold text-gray-400">
                            <span>Point : 0</span>
                            <span>100</span>
                        </div>
                    </div>
                    
                    <div class="space-y-4 mt-6">
                        {{-- Dummy Misi 1 --}}
                        <div class="flex items-center bg-white p-4 rounded-xl shadow-md">
                            <img src="{{ asset('assets/logo-rekawarisan.png') }}" class="w-12 mr-4 grayscale">
                            <div class="flex-grow">
                                <p class="font-medium text-gray-600">Membaca Pustaka Warisan</p>
                                <div class="flex items-center space-x-1">
                                    <span class="text-xs text-gray-500 font-bold">10 Poin</span>
                                </div>
                            </div>
                        </div>
                        {{-- Dummy Misi 2 --}}
                        <div class="flex items-center bg-white p-4 rounded-xl border border-gray-300 shadow-md">
                            <img src="{{ asset('assets/logo-rekawarisan.png') }}" class="w-12 mr-4 grayscale">
                            <div class="flex-grow">
                                <p class="font-medium text-gray-600">Pertanyaan Kuis</p>
                                <div class="flex items-center space-x-1">
                                    <span class="text-xs text-gray-500 font-bold">40 Poin</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 pt-4 border-t border-gray-200 mt-6">
                        <h2 class="text-2xl font-bold text-gray-500">Badge :</h2>
                        <p class="text-gray-400 italic">Login untuk melihat koleksi badge.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= GAMBAR BAPAK (Tengah Bawah) ================= --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-1 flex justify-center items-center">
            <img src="{{ asset('assets/jejakmaestro/bapakbapak.png') }}" alt="Bapak Maestro" class="max-w-full h-auto drop-shadow-xl">
        </div>

        {{-- ================= LEADERBOARD (LOCKED) ================= --}}
        <div class="col-span-6 md:col-span-3 lg:col-span-2 space-y-6 relative rounded-3xl overflow-hidden min-h-[500px]">
            
            {{-- OVERLAY CARD LOGIN (Style Gambar 1) --}}
            <div class="absolute inset-0 z-10 bg-gray-100/40 backdrop-blur-[3px] flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.3)] p-8 w-full max-w-xs text-center border border-gray-100 transform transition hover:scale-105 duration-300">
                    
                    {{-- Gembok Icon Simple --}}
                    <div class="flex justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="5" y="11" width="14" height="10" rx="2" ry="2" stroke-width="2"></rect>
                            <path d="M8 11V7a4 4 0 018 0v4" stroke-width="2" stroke-linecap="round"></path>
                            <circle cx="12" cy="16" r="1" fill="currentColor"></circle>
                        </svg>
                    </div>

                    <h3 class="text-lg font-extrabold text-gray-800 mb-2">Masuk untuk Melihat</h3>
                    <p class="text-xs text-gray-500 mb-6 leading-relaxed">Lihat peringkat lengkap dan posisi Anda di leaderboard.</p>
                    
                    <a href="{{ route('login') }}" class="block w-full bg-[#389A92] hover:bg-[#2D7A74] text-white font-bold py-2.5 rounded-lg shadow-md transition text-sm">
                        Masuk Sekarang
                    </a>
                </div>
            </div>

            {{-- KONTEN DUMMY DI BALIK LAYAR --}}
            <div class="bg-white p-6 rounded-3xl shadow-2xl border border-gray-200 space-y-4 h-full opacity-40 filter blur-[1px]">
                <h2 class="text-2xl font-extrabold text-[#145D63] text-center">Leaderboard Poin</h2>
                
                <div class="flex rounded-xl overflow-hidden shadow-lg bg-gray-100 p-1">
                    <div class="flex-1 py-2 text-sm font-bold text-center text-gray-700">Kota</div>
                    <div class="flex-1 py-2 text-sm font-bold text-center text-gray-700">Provinsi</div>
                    <div class="flex-1 py-2 text-sm font-bold text-center bg-[#389A92] text-white">Indonesia</div>
                </div>

                <div class="overflow-hidden relative mt-4">
                    <table class="min-w-full text-sm text-left text-gray-500">
                        <thead>
                            <tr class="text-xs uppercase font-bold border-b-2 border-gray-300">
                                <th class="py-2 px-2">No</th>
                                <th class="py-2 px-2">Nama</th>
                                <th class="py-2 px-2 text-right">Point</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 7; $i++)
                            <tr class="border-b border-gray-100">
                                <td class="py-2 px-2">{{ $i }}</td>
                                <td class="py-2 px-2 font-bold">Maestro {{ $i }}</td>
                                <td class="py-2 px-2 text-right">----</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection