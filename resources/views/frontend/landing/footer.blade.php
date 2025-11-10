<footer class="bg-gray-800 text-white pt-16 pb-8">
    <div class="container mx-auto px-6">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8 border-b border-gray-700 pb-12">
            
            <div class="lg:col-span-1 space-y-4">
                
                <div class="flex items-center space-x-3">
                    <img src="https://via.placeholder.com/64x64.png?text=Logo" alt="Logo Reka Warisan" class="w-12 h-12 rounded-full border border-white/20 p-1">
                    <span class="text-xl font-bold">Reka Warisan</span>
                </div>
                
                <p class="text-sm text-gray-400 max-w-xs leading-relaxed">
                    Jembatan Inovasi Warisan Budaya ke Ekonomi Digital Global. Platform terintegrasi untuk lisensi, kolaborasi, dan literasi digital warisan Nusantara.
                </p>
            </div>

            <div class="lg:col-span-1">
                <h3 class="text-sm font-bold uppercase tracking-wider text-white mb-4">NAVIGASI CEPAT</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="{{ route('beranda') }}" class="hover:text-white transition duration-200">Beranda</a></li>
                    <li><a href="" class="hover:text-white transition duration-200">Pustaka Warisan</a></li>
                    <li><a href="{{ route('jejakmaestro') }}" class="hover:text-white transition duration-200">Jejak Maestro</a></li>
                </ul>
            </div>

            <div class="lg:col-span-1">
                <h3 class="text-sm font-bold uppercase tracking-wider text-white mb-4">INFORMASI HUKUM & DUKUNGAN</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition duration-200">Hubungi Kami</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-white transition duration-200">FAQ</a></li>
                    <li><a href="{{ route('kebijakan-privasi') }}" class="hover:text-white transition duration-200">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <div class="lg:col-span-1">
                <h3 class="text-sm font-bold uppercase tracking-wider text-white mb-4">NEWSLETTER</h3>
                <form class="space-y-4">
                    <div class="relative">
                        <input type="email" placeholder="Masukkan alamat email Anda" 
                               class="w-full p-3 pl-12 text-sm bg-gray-700 border border-gray-600 rounded-lg placeholder-gray-400 focus:ring-green-500 focus:border-green-500 text-white"
                               required>
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-[#389A92] hover:bg-[#389A92]/90 text-white font-semibold py-3 rounded-lg transition duration-300 shadow-md">
                        Berlangganan Sekarang
                    </button>
                </form>
            </div>
            
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center pt-8 text-gray-400 text-sm">
            
            <p>&copy;2025 Reka Warisan. All Right Reserved</p>

            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition duration-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.777-1.63 1.563V12h2.77l-.44 2.89h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/></svg>
                </a>
                <a href="#" class="hover:text-white transition duration-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.28 9.445c.01-.19-.005-.38-.046-.57-.14-.66-.48-1.26-1.02-1.74-.54-.48-1.2-.82-1.92-.99-.72-.17-1.46-.24-2.2-.21h-1.6c-.66.01-1.31.14-1.92.37-.61.23-1.16.57-1.62.99-.46.42-.85.91-1.14 1.45-.29.54-.47 1.13-.53 1.73-.06.6-.04 1.2.06 1.8.1 1.2.39 2.3.85 3.32.46 1.02 1.09 1.93 1.9 2.65.81.72 1.77 1.28 2.8 1.66 1.03.38 2.15.58 3.28.58 1.1 0 2.2-.18 3.21-.52.93-.32 1.76-.87 2.45-1.64.69-.77 1.2-1.68 1.49-2.68.29-1 .4-2.03.31-3.06-.06-.8-.23-1.58-.49-2.34-.26-.76-.62-1.47-1.07-2.11zM12 21.5c-3.15 0-5.9-1.2-8.03-3.15-2.13-1.95-3.37-4.6-3.37-7.55s1.24-5.6 3.37-7.55C6.1 2.7 8.85 1.5 12 1.5s5.9 1.2 8.03 3.15c2.13 1.95 3.37 4.6 3.37 7.55s-1.24 5.6-3.37 7.55C17.9 20.3 15.15 21.5 12 21.5z"/></svg>
                </a>
                <a href="#" class="hover:text-white transition duration-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.32 15.25a3 3 0 01-4.64 0 3 3 0 014.64 0zm-7.61-9.58a1 1 0 110-2 1 1 0 010 2zm11.23 0a1 1 0 110-2 1 1 0 010 2zM12 8a4 4 0 100 8 4 4 0 000-8zm0 6a2 2 0 110-4 2 2 0 010 4z"/></svg>
                </a>
                <a href="#" class="hover:text-white transition duration-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm5.11 18.04c-.1.19-.3.26-.5.16-.92-.47-2.1-.75-3.35-.75-1.25 0-2.43.28-3.35.75-.2.1-.4.03-.5-.16-.1-.19-.03-.4.16-.5C8.89 16.51 10.37 16 12 16c1.63 0 3.11.51 4.29 1.54.19.1.26.3.16.5zM12 6a4 4 0 100 8 4 4 0 000-8z"/></svg>
                </a>
            </div>

        </div>
    </div>
</footer>