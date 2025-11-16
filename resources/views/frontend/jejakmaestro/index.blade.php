@extends('frontend.layout.app', ['title' => 'Jejak Maestro'])
@section('content')
<section class="bg-gray-50 min-h-screen pb-16">

    <!-- hero section -->
    <div class="rounded-xl min-h-[35vh] flex flex-col items-center justify-center text-center px-6 pt-20 **mt-[-5rem]**" style="background-image: url('{{ asset('assets/landing/background-herosection.png') }}'); background-size: cover; background-repeat: no-repeat; background-position: center; ">
            <div class="container mx-auto px-6 relative z-10 text-center">
                <h1 class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl xl:text-[6rem] font-black tracking-tight text-yellow-400 drop-shadow-2xl leading-none">
                    Jejak Maestro
                </h1>
            </div>
    </div>
    <!-- end hero section -->

    <div class="container mx-auto px-6 mt-10 grid grid-cols-6 gap-4">

        <div class="col-span-6 md:col-span-3 lg:col-span-4 bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-2xl p-8 border border-[#389A92]/20 overflow-hidden relative group hover:shadow-2xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-[#389A92]/10 to-transparent rounded-full blur-xl"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-amber-400/10 to-transparent rounded-full blur-lg"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center relative z-10">
                <div class="md:col-span-2 space-y-6">
                    <div class="space-y-2">
                        <h2 class="text-4xl font-black text-[#145D63] leading-tight">
                            Halo, Pejuang Budaya <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#389A92] to-amber-500">!</span>
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
                                <p class="text-gray-600 mb-4 leading-relaxed">Tuntaskan semua tugas harianmu dan buka Lencana Eksklusif (Kontributor Artikel Budaya)</p>
                                <a href="#" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#389A92] to-[#2D7A74] hover:from-[#2D7A74] hover:to-[#389A92] text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <span>Mulai Misi</span>
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="md:col-span-1 flex justify-center">
                    <div class="relative group/mascot">
                        <div class="absolute -inset-4 bg-gradient-to-r from-[#389A92] to-amber-400 rounded-full blur-lg opacity-30 group-hover/mascot:opacity-50 transition-all duration-500"></div>
                        <img src="{{ asset('assets/jejakmaestro/maskot-jejakmaestro.png') }}" alt="Mascot Lumba-lumba" class="w-full max-w-[250px] h-auto transform group-hover/mascot:scale-105 transition-transform duration-500 relative z-10">
                    </div>
                </div>
            </div>
        </div>

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
                            <h3 class="font-bold text-gray-800 mb-2">Tantangan Poin Harian</h3>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">Selesaikan Misi Harian untuk Lencana dan Hadiah (Misal: Menambah Konten Budaya Lokal).</p>
                            <a href="#" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-yellow-500 hover:to-amber-500 text-white font-semibold py-2.5 px-5 rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-sm">
                                <span>Mulai Misi</span>
                                <svg class="w-3 h-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-span-6 md:col-span-3 lg:col-span-3 space-y-6">
            <h2 class="text-3xl font-black text-gray-900 border-b-2 border-gray-200 pb-2">Misi Harian</h2>
                
            <div class="space-y-1">
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="h-3 rounded-full" style="width: 77%; background: linear-gradient(to right, #389A92 50%, #FFCC00 100%);"></div>
                </div>
                <div class="flex justify-between text-base font-bold text-gray-700">
                    <span class="text-lg font-extrabold text-[#389A92]">Point : 77</span>
                    <span class="text-gray-500">100</span>
                </div>
            </div>
            
            <div class="space-y-4">
                
                <div class="flex items-center bg-white p-4 rounded-xl shadow-md">
                    <img src="{{ asset('assets/logo-rekawarisan.png') }}" alt="Logo Deka Warisan" class="w-12 mr-4">
                        
                    <div class="flex-grow">
                        <p class="font-medium text-gray-900">Membaca Pustaka Warisan 1 Menit</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zM6 10a4 4 0 118 0 4 4 0 01-8 0z"></path></svg>
                                <span class="text-xs text-amber-600 font-bold">10</span>
                            </div>
                            <p class="text-sm font-semibold text-green-600 mb-1">Misi Selesai</p>
                        </div>
                    </div>
                    
                    <div class="text-right">
                        <img src="{{ asset('assets/jejakmaestro/misi/logo-misi-done.png') }}" alt="Hadiah Peti" class="w-18">
                    </div>
                </div>

                <div id="open-quiz-modal" class="flex items-center bg-white p-4 rounded-xl border border-gray-300 shadow-md cursor-pointer hover:shadow-lg transition duration-300">
                    <img src="{{ asset('assets/logo-rekawarisan.png') }}" alt="Logo Deka Warisan" class="w-12 mr-4">
                    <div class="flex-grow">
                        <p class="font-medium text-gray-900">Pertanyaan Kuiz</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zM6 10a4 4 0 118 0 4 4 0 01-8 0z"></path></svg>
                                <span class="text-xs text-amber-600 font-bold">40</span>
                            </div>
                            <p class="text-sm font-semibold text-red-500 mb-1">Belum Selesai</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <img src="{{ asset('assets/jejakmaestro/misi/logo-misi-not-done.png') }}" alt="Hadiah Peti Belum Selesai" class="w-18">
                    </div>
                </div>

                <div id="quiz-modal" class="fixed inset-0 z-50 hidden bg-gray-900/50 backdrop-blur-sm flex items-center justify-center">
                    
                    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-4 p-6 relative">
                        
                        <div class="flex justify-between items-center border-b pb-3 mb-4">
                            <h3 class="text-xl font-bold text-gray-800">Uji Pemahaman: Pustaka Warisan</h3>
                            <button id="close-quiz-modal" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        
                        <form action="/submit-kuis" method="POST">
                            
                            <div class="mb-6">
                                <p class="font-semibold text-gray-700 mb-3">1. Apa budaya asli Jawa yang diakui UNESCO sebagai Warisan Budaya Takbenda?</p>
                                
                                <div class="space-y-3">
                                    <label class="flex items-center bg-gray-50 p-3 rounded-lg hover:bg-gray-100 cursor-pointer transition">
                                        <input type="radio" name="jawaban_soal_1" value="tari_saman" class="form-radio text-amber-500">
                                        <span class="ml-3 text-gray-800">Tari Saman</span>
                                    </label>
                                    
                                    <label class="flex items-center bg-gray-50 p-3 rounded-lg hover:bg-gray-100 cursor-pointer transition">
                                        <input type="radio" name="jawaban_soal_1" value="wayang" class="form-radio text-amber-500">
                                        <span class="ml-3 text-gray-800">Wayang Kulit</span>
                                    </label>

                                    <label class="flex items-center bg-gray-50 p-3 rounded-lg hover:bg-gray-100 cursor-pointer transition">
                                        <input type="radio" name="jawaban_soal_1" value="reog" class="form-radio text-amber-500">
                                        <span class="ml-3 text-gray-800">Reog Ponorogo</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="pt-4 border-t flex justify-end">
                                <button type="submit" class="bg-amber-500 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:bg-amber-600 transition duration-300">
                                    Kirim Jawaban
                                </button>
                            </div>
                            
                        </form>
                        
                    </div>
                </div>

                <div class="bg-gray-800 p-4 rounded-xl flex items-center justify-center space-x-3 shadow-md">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <p class="text-gray-400 font-medium">Misi Ini Belum Tersedia</p>
                </div>
                
            </div>

            <div class="space-y-4 pt-4 border-t border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Badge :</h2>
                <div class="flex flex-wrap gap-4 justify-start">
                    <img src="{{ asset('assets/jejakmaestro/badge/badge1.png') }}" alt="Badge 1" class="w-20 h-20 rounded-full shadow-lg border-2 border-yellow-500">
                    <img src="{{ asset('assets/jejakmaestro/badge/badge2.png') }}" alt="Badge 2" class="w-20 h-20 rounded-full shadow-lg border-2 border-yellow-500">
                    <img src="{{ asset('assets/jejakmaestro/badge/badge3.png') }}" alt="Badge 3" class="w-20 h-20 rounded-full shadow-lg border-2 border-yellow-500">
                </div>
            </div>
        </div>

        <div class="col-span-6 md:col-span-3 lg:col-span-1 flex justify-center items-center">
            <img src="{{ asset('assets/jejakmaestro/bapakbapak.png') }}" alt="Bapak-bapak Maestro" class="max-w-full h-auto">
        </div>

        <div class="col-span-6 md:col-span-3 lg:col-span-2 space-y-6">

            <div class="bg-white p-6 rounded-3xl shadow-2xl border border-gray-200 space-y-4">
                <h2 class="text-2xl font-extrabold text-[#145D63] text-center">Leaderboard Poin</h2>
                
                <div class="flex rounded-xl overflow-hidden shadow-lg bg-gray-100 p-1">
                    <button id="tab-kota" onclick="showLeaderboard('kota')" class="tab-button flex-1 py-2 text-sm font-bold text-gray-700 hover:bg-gray-200 transition rounded-lg">Kota</button>
                    <button id="tab-prov" onclick="showLeaderboard('provinsi')" class="tab-button flex-1 py-2 text-sm font-bold text-gray-700 hover:bg-gray-200 transition rounded-lg">Provinsi</button>
                    <button id="tab-indonesia" onclick="showLeaderboard('indonesia')" class="tab-button flex-1 py-2 text-sm font-bold bg-[#389A92] text-white shadow-md">Indonesia</button>
                </div>

                <div class="overflow-x-auto h-[400px] relative">
                    
                    <div id="leaderboard-indonesia" class="leaderboard-content absolute inset-0 transition-opacity duration-300">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead>
                                <tr class="text-xs uppercase font-bold text-[#2D7A74] border-b-2 border-gray-300">
                                    <th scope="col" class="py-2 px-2">No</th>
                                    <th scope="col" class="py-2 px-2">Nama</th>
                                    <th scope="col" class="py-2 px-2 text-right">Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-100 font-bold bg-yellow-50">
                                    <td class="py-2 px-2">1</td>
                                    <td class="py-2 px-2">Danu</td>
                                    <td class="py-2 px-2 text-right text-amber-600">3900</td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-2 px-2">2</td>
                                    <td class="py-2 px-2">Rita</td>
                                    <td class="py-2 px-2 text-right">3800</td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-2 px-2">3</td>
                                    <td class="py-2 px-2">Risol</td>
                                    <td class="py-2 px-2 text-right">3700</td>
                                </tr>
                                <tr><td class="py-1 px-2">4</td><td class="py-1 px-2">Musab</td><td class="py-1 px-2 text-right">3600</td></tr>
                                <tr><td class="py-1 px-2">5</td><td class="py-1 px-2">Supri</td><td class="py-1 px-2 text-right">3500</td></tr>
                                <tr><td class="py-1 px-2">6</td><td class="py-1 px-2">Sulaiman</td><td class="py-1 px-2 text-right">3400</td></tr>
                                <tr><td class="py-1 px-2">7</td><td class="py-1 px-2">Rudi</td><td class="py-1 px-2 text-right">3300</td></tr>
                                <tr><td class="py-1 px-2">8</td><td class="py-1 px-2">June</td><td class="py-1 px-2 text-right">3200</td></tr>
                                <tr><td class="py-1 px-2">9</td><td class="py-1 px-2">Albert</td><td class="py-1 px-2 text-right">3100</td></tr>
                                <tr><td class="py-1 px-2">10</td><td class="py-1 px-2">Enstain</td><td class="py-1 px-2 text-right text-red-500">300</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="leaderboard-provinsi" class="leaderboard-content absolute inset-0 hidden transition-opacity duration-300">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead>
                                <tr class="text-xs uppercase font-bold text-[#2D7A74] border-b-2 border-gray-300">
                                    <th scope="col" class="py-2 px-2">No</th>
                                    <th scope="col" class="py-2 px-2">Nama</th>
                                    <th scope="col" class="py-2 px-2 text-right">Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-100 font-bold bg-green-50">
                                    <td class="py-2 px-2">1</td>
                                    <td class="py-2 px-2">Slamet (Jawa T.)</td>
                                    <td class="py-2 px-2 text-right text-green-600">1250</td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-2 px-2">2</td>
                                    <td class="py-2 px-2">Budi (Jawa B.)</td>
                                    <td class="py-2 px-2 text-right">1100</td>
                                </tr>
                                <tr><td class="py-1 px-2">3</td><td class="py-1 px-2">Cindy (Bali)</td><td class="py-1 px-2 text-right">980</td></tr>
                                </tbody>
                        </table>
                    </div>

                    <div id="leaderboard-kota" class="leaderboard-content absolute inset-0 hidden transition-opacity duration-300">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead>
                                <tr class="text-xs uppercase font-bold text-[#2D7A74] border-b-2 border-gray-300">
                                    <th scope="col" class="py-2 px-2">No</th>
                                    <th scope="col" class="py-2 px-2">Nama</th>
                                    <th scope="col" class="py-2 px-2 text-right">Point</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-100 font-bold bg-blue-50">
                                    <td class="py-2 px-2">1</td>
                                    <td class="py-2 px-2">Dian (Bandung)</td>
                                    <td class="py-2 px-2 text-right text-blue-600">550</td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="py-2 px-2">2</td>
                                    <td class="py-2 px-2">Eko (Surabaya)</td>
                                    <td class="py-2 px-2 text-right">480</td>
                                </tr>
                                <tr><td class="py-1 px-2">3</td><td class="py-1 px-2">Fajar (Jakarta)</td><td class="py-1 px-2 text-right">400</td></tr>
                                </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</section>


<script>
    function showLeaderboard(activeTabId) {
        // 1. Kelola Konten (Table)
        const contents = document.querySelectorAll('.leaderboard-content');
        contents.forEach(content => {
            if (content.id === 'leaderboard-' + activeTabId) {
                // Tampilkan konten yang sesuai
                content.classList.remove('hidden');
            } else {
                // Sembunyikan konten lainnya
                content.classList.add('hidden');
            }
        });

        // 2. Kelola Styling Tombol Tab
        const tabs = document.querySelectorAll('.tab-button');
        tabs.forEach(tab => {
            // Hapus styling aktif dari semua tombol
            tab.classList.remove('bg-[#389A92]', 'text-white', 'shadow-md');
            tab.classList.add('text-gray-700');
            tab.classList.remove('hover:bg-gray-200'); // Tambahkan kembali hover
        });

        // Tambahkan styling aktif pada tombol yang diklik
        const activeTab = document.getElementById('tab-' + activeTabId);
        activeTab.classList.add('bg-[#389A92]', 'text-white', 'shadow-md');
        activeTab.classList.remove('text-gray-700');
        activeTab.classList.remove('hover:bg-gray-200'); // Hapus hover jika sedang aktif
    }

    // Panggil fungsi ini saat halaman dimuat untuk memastikan 'Indonesia' aktif secara default
    document.addEventListener('DOMContentLoaded', () => {
        showLeaderboard('indonesia');
    });

    document.addEventListener('DOMContentLoaded', function() {
        const openModalButton = document.getElementById('open-quiz-modal');
        const closeModalButton = document.getElementById('close-quiz-modal');
        const quizModal = document.getElementById('quiz-modal');

        // Buka modal saat kartu diklik
        openModalButton.addEventListener('click', function() {
            quizModal.classList.remove('hidden');
        });

        // Tutup modal saat tombol 'X' diklik
        closeModalButton.addEventListener('click', function() {
            quizModal.classList.add('hidden');
        });

        // Tutup modal saat klik di luar area konten modal
        quizModal.addEventListener('click', function(e) {
            if (e.target === quizModal) {
                quizModal.classList.add('hidden');
            }
        });
    });
</script>
@endsection