@extends('frontend.layout.app', ['title' => 'Jejak Maestro'])
@section('content')
<section class="bg-gray-50 min-h-screen pb-16">
    
    <header class="relative py-12 bg-[#145D63] overflow-hidden">
        <div class="absolute inset-0 opacity-50 z-0" 
             style="background-image: url('https://via.placeholder.com/1000x300.png?text=Pola+Batik+Teal'); background-repeat: repeat; background-size: 200px;">
        </div>
        
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-yellow-400 drop-shadow-lg">
                Jejak Maestro
            </h1>
        </div>
    </header>

    <div class="container  mx-auto px-6 mt-10 grid grid-cols-6 gap-4">

        <div class="col-span-6 md:col-span-3 lg:col-span-4 bg-white rounded-3xl shadow-xl p-6 border border-[#389A92]/40 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                        
                <div class="md:col-span-2 space-y-3">
                    <h2 class="text-3xl font-extrabold text-[#145D63]">Selamat Sore !</h2>
                    <p class="text-gray-600">Taklukkan misi untuk mendapatkan hadiah! Misi direset setiap hari.</p>
                            
                    <div class="bg-gray-100 p-4 rounded-xl border border-gray-200">
                        <h3 class="font-bold text-gray-800 mb-2">Kumpulkan Poin Sebanyaknya</h3>
                        <p class="text-sm text-gray-600 mb-3">Selesaikan Misi-Misi Nya setiap hari untuk mendapatkan Badge eksklusif (Menambahkan Artikel Budaya )</p>
                        <a href="#" class="inline-block bg-[#389A92] hover:bg-[#389A92]/90 text-white text-xs font-semibold py-2 px-4 rounded-md transition">
                            Mulai Misi
                        </a>
                    </div>
                </div>
                        
                <div class="md:col-span-1 flex justify-center">
                    <img src="{{ asset('assets/jejakmaestro/maskot-jejakmaestro.png') }}" alt="Mascot Lumba-lumba" class="w-full max-w-[250px] h-auto">
                </div>
            </div>
        </div>

        <div class="col-span-6 md:col-span-3 lg:col-span-2 bg-white rounded-3xl shadow-xl p-6 border border-[#389A92]/40 overflow-hidden">         
            <div class="md:col-span-2 space-y-3">
                <h2 class="text-3xl font-extrabold text-[#145D63]">Selamat Sore !</h2>
                <p class="text-gray-600">Taklukkan misi untuk mendapatkan hadiah! Misi direset setiap hari.</p>
                            
                <div class="bg-gray-100 p-4 rounded-xl border border-gray-200">
                    <h3 class="font-bold text-gray-800 mb-2">Kumpulkan Poin Sebanyaknya</h3>
                    <p class="text-sm text-gray-600 mb-3">Selesaikan Misi-Misi Nya setiap hari untuk mendapatkan Badge eksklusif (Menambahkan Artikel Budaya )</p>
                    <a href="#" class="inline-block bg-[#389A92] hover:bg-[#389A92]/90 text-white text-xs font-semibold py-2 px-4 rounded-md transition">
                    Mulai Misi
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-span-6 md:col-span-3 lg:col-span-3 space-y-6">
            <h2 class="text-2xl font-bold text-gray-900">Misi Harian</h2>
                
                <div class="space-y-1">
                    <div class="flex justify-between text-sm font-medium text-gray-700">
                        <span>Point: 77</span>
                        <span>100</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="h-2.5 rounded-full" style="width: 77%; background: linear-gradient(to right, #389A92 50%, #FFCC00 100%);"></div>
                    </div>
                        
                    <div class="flex items-center bg-white p-4 rounded-xl border border-green-500/40 shadow-sm opacity-60">
                        <div class="p-2 mr-4 bg-green-100 rounded-full">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </div>
                            
                        <div class="flex-grow">
                            <p class="font-medium text-gray-900">Membaca Pustaka Warisan 1 Menit</p>
                            <p class="text-xs text-gray-500">Point: +10</p>
                        </div>
                            
                        <button class="bg-[#389A92] text-white text-sm py-2 px-4 rounded-lg cursor-not-allowed">
                            Misi Selesai
                        </button>
                    </div>

                    <div class="flex items-center bg-white p-4 rounded-xl border border-gray-300 shadow-sm">
                        <div class="p-2 mr-4 bg-yellow-100 rounded-full">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                            
                        <div class="flex-grow">
                            <p class="font-medium text-gray-900">Membaca Pustaka Warisan 100 Menit</p>
                            <p class="text-xs text-red-500">Belum Selesai</p>
                        </div>
                            
                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm py-2 px-4 rounded-lg transition duration-200">
                            Mulai
                        </button>
                    </div>

                    <div class="bg-gray-800 p-4 rounded-xl flex items-center justify-center space-x-3 shadow-md">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <p class="text-gray-400 font-medium">Misi Ini Belum Tersedia</p>
                    </div>
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-gray-900">Badge :</h2>
                        <div class="flex flex-wrap gap-4 justify-start">
                            <img src="https://via.placeholder.com/80x80.png?text=B1" alt="Badge 1" class="w-20 h-20 rounded-full shadow-lg border-2 border-yellow-500">
                            <img src="https://via.placeholder.com/80x80.png?text=B2" alt="Badge 2" class="w-20 h-20 rounded-full shadow-lg border-2 border-gray-300 opacity-50">
                            <img src="https://via.placeholder.com/80x80.png?text=B3" alt="Badge 3" class="w-20 h-20 rounded-full shadow-lg border-2 border-yellow-500">
                        </div>
                    </div>
            
                </div>

        </div>

        <div class="col-span-6 md:col-span-3 lg:col-span-1 flex justify-center items-center">
            <img src="{{ asset('assets/jejakmaestro/bapakbapak.png') }}" alt="Bapak-bapak Maestro" class="max-w-full h-auto">
        </div>

        <div class="col-span-6 md:col-span-3 lg:col-span-2 space-y-6">

            <div class="bg-gray-200 p-6 rounded-3xl shadow-xl space-y-4">
                <h2 class="text-2xl font-bold text-gray-800 text-center">Leaderboard</h2>
                
                <div class="flex rounded-lg overflow-hidden shadow-inner bg-gray-300">
                    <button class="flex-1 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-400 transition">Kota</button>
                    <button class="flex-1 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-400 transition">Prov</button>
                    <button class="flex-1 py-2 text-sm font-semibold bg-[#389A92] text-white">Indonesia</button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-600">
                        <thead>
                            <tr class="text-xs uppercase text-gray-700 border-b border-gray-300">
                                <th scope="col" class="py-2 px-1">No</th>
                                <th scope="col" class="py-2 px-1">Nama</th>
                                <th scope="col" class="py-2 px-1">Point</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-300 font-bold bg-yellow-100/50">
                                <td class="py-2 px-1">1</td>
                                <td class="py-2 px-1">Danu</td>
                                <td class="py-2 px-1 text-yellow-600">3900</td>
                            </tr>
                            <tr class="border-b border-gray-300">
                                <td class="py-2 px-1">2</td>
                                <td class="py-2 px-1">Rita</td>
                                <td class="py-2 px-1">3800</td>
                            </tr>
                             <tr class="border-b border-gray-300">
                                <td class="py-2 px-1">3</td>
                                <td class="py-2 px-1">Risol</td>
                                <td class="py-2 px-1">3700</td>
                            </tr>
                             <tr><td class="py-1 px-1">4</td><td class="py-1 px-1">Musab</td><td class="py-1 px-1">3600</td></tr>
                            <tr><td class="py-1 px-1">5</td><td class="py-1 px-1">Supri</td><td class="py-1 px-1">3500</td></tr>
                            <tr><td class="py-1 px-1">6</td><td class="py-1 px-1">Sulaiman</td><td class="py-1 px-1">3400</td></tr>
                            <tr><td class="py-1 px-1">7</td><td class="py-1 px-1">Rudi</td><td class="py-1 px-1">3300</td></tr>
                            <tr><td class="py-1 px-1">8</td><td class="py-1 px-1">June</td><td class="py-1 px-1">3200</td></tr>
                            <tr><td class="py-1 px-1">9</td><td class="py-1 px-1">Albert</td><td class="py-1 px-1">3100</td></tr>
                            <tr><td class="py-1 px-1">10</td><td class="py-1 px-1">Enstain</td><td class="py-1 px-1 text-red-500">300</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection