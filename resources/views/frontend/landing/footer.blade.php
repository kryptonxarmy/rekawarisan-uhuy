<footer class="bg-gradient-to-br from-[#313131] via-[#313131] to-[#313131] text-white pt-20 pb-12 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0">
        <!-- Floating Orbs -->
        <div class="absolute top-10 left-10 w-6 h-6 bg-white/10 rounded-full animate-float-slow"></div>
        <div class="absolute top-40 right-20 w-4 h-4 bg-amber-300/20 rounded-full animate-float-medium delay-1000"></div>
        <div class="absolute bottom-32 left-1/4 w-8 h-8 bg-white/5 rounded-full animate-float-slow delay-500"></div>
        
        <!-- Gradient Blobs -->
        <div class="absolute -top-32 -left-32 w-64 h-64 bg-gradient-to-br from-amber-400/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 w-80 h-80 bg-gradient-to-tl from-[#127E80]/20 to-transparent rounded-full blur-3xl"></div>
        
        <!-- Pattern Overlay -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"1\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 border-b border-white/20 pb-16">
            
            <!-- Brand Section -->
            <div class="lg:col-span-1 space-y-6">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/logo-rekawarisan-white.png') }}" alt="Logo Reka Warisan" class="w-16 h-16 drop-shadow-lg">
                </div>
                <p class="text-gray-200 text-sm leading-relaxed max-w-xs">
                    Jembatan Inovasi Warisan Budaya ke Ekonomi Digital Global. Platform terintegrasi untuk lisensi, kolaborasi, dan literasi digital warisan Nusantara.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="lg:col-span-1">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <div class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></div>
                    NAVIGASI CEPAT
                </h3>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('beranda') }}" class="text-gray-300 hover:text-amber-300 transition-all duration-300 flex items-center gap-2 group">
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pustakawarisan') }}" class="text-gray-300 hover:text-amber-300 transition-all duration-300 flex items-center gap-2 group">
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Pustaka Warisan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('jejakmaestro') }}" class="text-gray-300 hover:text-amber-300 transition-all duration-300 flex items-center gap-2 group">
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Jejak Maestro
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Legal & Support -->
            <div class="lg:col-span-1">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    INFORMASI & DUKUNGAN
                </h3>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('contact') }}" class="text-gray-300 hover:text-amber-300 transition-all duration-300 flex items-center gap-2 group">
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Hubungi Kami
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('faq') }}" class="text-gray-300 hover:text-amber-300 transition-all duration-300 flex items-center gap-2 group">
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kebijakan-privasi') }}" class="text-gray-300 hover:text-amber-300 transition-all duration-300 flex items-center gap-2 group">
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Kebijakan Privasi
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="lg:col-span-1">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                    NEWSLETTER
                </h3>
                <div class="space-y-4">
                    <p class="text-gray-200 text-sm leading-relaxed">
                        Dapatkan update terbaru tentang fitur, event, dan konten eksklusif warisan budaya.
                    </p>
                    
                    <form  id="newsletterForm" class="space-y-4">
                        <div class="relative group">
                            <input type="email" placeholder="Masukkan alamat email Anda" 
                                   class="w-full p-4 pl-12 text-sm bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl placeholder-gray-300 focus:ring-2 focus:ring-amber-400 focus:border-amber-400 text-white transition-all duration-300 group-hover:bg-white/15"
                                   required>
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-300 group-hover:text-amber-300 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 border border-amber-300/50 group relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 transform translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                            <span class="flex items-center justify-center gap-2 relative z-10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                                Berlangganan Sekarang
                            </span>
                        </button>
                    </form>
                </div>
            </div>
            
        </div>

        <!-- Bottom Section -->
        <div class="flex flex-col md:flex-row justify-between items-center pt-8 text-gray-300">
            
            <!-- Copyright -->
            <div class="flex items-center gap-4 mb-4 md:mb-0">
                <p class="text-sm">&copy; 2025 Reka Warisan. All Rights Reserved</p>
                <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                <p class="text-sm">Made with ❤️ for Indonesia</p>
            </div>

            <!-- Social Media -->
            <div class="flex items-center gap-6">
                <span class="text-sm text-gray-400 hidden md:block">Follow Us:</span>
                <div class="flex space-x-5">
                    <a href="https://www.facebook.com" class="w-10 h-10 bg-white/10 hover:bg-amber-500 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg group">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.563V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                    </a>
                    <a href="https://www.youtube.com" class="w-10 h-10 bg-white/10 hover:bg-blue-500 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg group">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                        </svg>
                    </a>
                    <a href="https://www.pinterest.com" class="w-10 h-10 bg-white/10 hover:bg-pink-500 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg group">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.017 12.017 0z"/>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com" class="w-10 h-10 bg-white/10 hover:bg-blue-400 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg group">
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</footer>

<style>
    @keyframes float-slow {
    0%, 100% { transform: translateY(0) translateX(0); }
    50% { transform: translateY(-10px) translateX(5px); }
    }
    @keyframes float-medium {
    0%, 100% { transform: translateY(0) translateX(0); }
    50% { transform: translateY(-8px) translateX(-3px); }
    }

    .animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
    }
    .animate-float-medium {
    animation: float-medium 4s ease-in-out infinite;
    }

    /* Smooth transitions */
    * {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
    }
</style>

<script>
    // Pastikan skrip berjalan setelah semua elemen HTML dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen form berdasarkan ID
        const form = document.getElementById('newsletterForm');
        
        // Pengecekan krusial
        if (!form) {
            console.error('ERROR: Form dengan ID "contactForm" tidak ditemukan.');
            return;
        }

        // Tambahkan event listener untuk submit
        form.addEventListener('submit', function(e) {
            // Mencegah form melakukan submit default (yang menyebabkan refresh instan)
            e.preventDefault(); 
            
            // Tampilkan Notifikasi (Alert)
            // Menggunakan gaya Antusias & Modern
            alert("Berhasil! Terima kasih telah mendaftar di Reka Warisan. Bersiaplah, karena kami akan segera mengirimkan inspirasi dan berita terhangat langsung ke email Anda!");
                        
            // Refresh Halaman: Ini hanya akan dijalankan setelah pengguna menekan 'OK' pada alert.
            window.location.reload(); 
        });
    });
</script>