<!-- hero section -->
<div class="flex flex-col items-center text-center px-6" style="background-image: url('{{ asset('assets/landing/background-herosection.png') }}')">
    <img src="{{ asset('assets/landing/logo-herosection.png') }}" alt="">
    <p class="text-white mt-4">
        Jelajahi akademi literasi digital interaktif, hadapi tantangan 'Jejak Maestro', dan temukan cara baru berkreasi dari warisan Indonesia. Untuk seluruh pembelajar di Indonesia dan dunia.
    </p>
</div>
<!-- end hero section -->

<!-- about section -->
<section class="bg-white py-16 sm:py-24">
  <div class="container mx-auto px-6">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-center">

      <div class="md:col-span-1 order-1 flex justify-center">
        <img src="{{ asset('assets/landing/maskot-landing.png') }}" alt="Maskot Reka Warisan" class="w-3/4 md:w-full max-w-xs md:max-w-md">
      </div>

      <div class="md:col-span-2 order-2 text-center md:text-left">
        
        <span class="inline-block bg-[#389A92] text-white text-sm font-semibold px-4 py-1.5 rounded-full">
          Tentang Reka Warisan
        </span>

        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mt-4 tracking-tight">
          Mengapa Reka Warisan Hadir?
        </h1>

        <p class="text-lg text-gray-800 leading-relaxed mb-6">
          Indonesia, dengan ribuan warisan budaya yang tak ternilai, kini menghadapi tantangan besar: bagaimana mentransformasi kekayaan tradisi menjadi aset ekonomi yang relevan di era digital?
        </p>
        
        <p class="text-lg text-gray-700 leading-relaxed">
          Kesenjangan antara pengetahuan budaya, pelaku seni, dan pasar modern kian melebar. Kami melihat peluang di balik tantangan ini. Reka Warisan adalah jembatan inovatif yang menghubungkan masa lalu dengan masa depan, mengubah warisan budaya Anda menjadi peluang ekonomi digital global yang berkelanjutan.
        </p>

      </div>
    </div>
  </div>
</section>
<!-- end about section -->

<!-- fitur section -->
<section class="bg-white py-16 sm:py-24 overflow-hidden">
  <div class="container mx-auto px-6">
    
    <div class="text-center mb-12">
        <span class="inline-block bg-[#389A92] text-white text-sm font-semibold px-4 py-1.5 rounded-full">
            Inovasi Reka Warisan
        </span>

        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mt-3 tracking-tight">
            Fitur Utama Reka Warisan
        </h1>
    </div>

    <div class="flex flex-col md:grid md:grid-cols-2 gap-8 md:gap-10 justify-center relative">

        <div class="hidden md:block absolute top-10 -left-10 opacity-10 transform -rotate-12">
             <img src="https://via.placeholder.com/200x200.png?text=Dekorasi+Kiri" alt="Dekorasi Batik" class="w-48 h-auto">
        </div>

        <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden p-3 transition duration-300 hover:shadow-2xl">
            <div class="grid grid-cols-1">
                <div class="relative mb-4 rounded-2xl overflow-hidden">
                    <img src="{{ asset('assets/landing/img-pustakawarisan.png') }}" alt="Pustaka Warisan" class="w-full h-auto object-cover">
                </div>

                <div class="text-center pt-2 pb-3">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Pustaka Warisan</h2>
                    
                    <div class="flex justify-center space-x-4">
                        <a href="#" 
                           class="bg-[#389A92] hover:bg-[#389A92]/90 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                           Selengkapnya
                        </a>
                        
                        <a href="#" 
                           class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-8 rounded-lg transition duration-300">
                           Lihat
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden p-3 transition duration-300 hover:shadow-2xl">
            <div class="grid grid-cols-1">
                <div class="relative mb-4 rounded-2xl overflow-hidden">
                     <img src="{{ asset('assets/landing/img-jejakmaestro.png') }}" alt="Jejak Maestro" class="w-full h-auto object-cover">
                </div>

                <div class="text-center pt-2 pb-3">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Jejak Maestro</h2>
                    
                    <div class="flex justify-center space-x-4">
                        <a href="#" 
                           class="bg-[#389A92] hover:bg-[#389A92]/90 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                           Selengkapnya
                        </a>
                        
                        <a href="#" 
                           class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-8 rounded-lg transition duration-300">
                           Lihat
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
  </div>
</section>
<!-- end fitur section -->

<!-- keunggulan section -->
 <section class="bg-white py-16 sm:py-24">
    <div class="container mx-auto px-6">
        
        <div class="text-center mb-12">
            <h2 class="text-xs font-semibold uppercase tracking-widest text-[#389A92] mb-2">
                Nilai Kami
            </h2>
            <p class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
                Keunggulan Reka Warisan
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-12 mt-12">
            
            <div class="text-center p-8 bg-gray-50 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                
                <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center rounded-full bg-[#389A92] bg-opacity-10">
                    <svg class="w-8 h-8 text-[#389A92]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9.25 10.75M14.25 17L14.75 10.75M21 12H3M12 21V3"/>
                    </svg>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-3">
                    Digitalisasi Akurat
                </h3>
                
                <p class="text-gray-600">
                    Kami menggunakan teknologi pemindaian 3D dan dokumentasi detail untuk melestarikan warisan budaya Anda dalam format digital yang tak tertandingi.
                </p>
            </div>

            <div class="text-center p-8 bg-gray-50 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                
                <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center rounded-full bg-[#389A92] bg-opacity-10">
                    <svg class="w-8 h-8 text-[#389A92]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2M3 9h2M3 13h2m8-8h2m-2 4h2m-2 4h2M9 5h2M9 9h2m-2 4h2M15 5h2m-2 4h2m-2 4h2M7 17h10M7 21h10"/>
                    </svg>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-3">
                    Jaringan Pemasaran Global
                </h3>
                
                <p class="text-gray-600">
                    Warisan Anda dipromosikan ke kolektor dan pasar seni internasional, membuka peluang ekonomi yang sebelumnya tidak terjangkau.
                </p>
            </div>

            <div class="text-center p-8 bg-gray-50 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                
                <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center rounded-full bg-[#389A92] bg-opacity-10">
                    <svg class="w-8 h-8 text-[#389A92]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-3">
                    Pelestarian Berkelanjutan
                </h3>
                
                <p class="text-gray-600">
                    Setiap transaksi yang terjadi memberikan kontribusi langsung kepada seniman dan pelestari budaya, memastikan tradisi tetap hidup.
                </p>
            </div>

        </div>
    </div>
</section>
<!-- end keunggulan section -->
 
<!-- pustaka warisan -->
<section class="bg-white py-16 sm:py-24 relative overflow-hidden">
  <div class="container mx-auto px-6">
    
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
            Pustaka Warisan
        </h1>
    </div>

    <div class="hidden md:block absolute top-1/2 right-0 transform -translate-y-1/2 opacity-20 z-0">
         <img src="{{ asset('assets/landing/Patern-wayang-right.png') }}" alt="Dekorasi Warisan" class="w-72 h-auto">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-8 md:gap-12 items-center relative z-10">

        <div class="md:col-span-3">
            <div class="relative rounded-3xl shadow-2xl overflow-hidden transform transition duration-300 hover:scale-[1.01]">
                <img src="{{ asset('assets/landing/img-pustakawarisan.png') }}" alt="Ilustrasi Pustaka Warisan" class="w-full h-auto object-cover">
            </div>
        </div>

        <div class="md:col-span-2 space-y-4">
            
            <span class="inline-block bg-[#389A92] text-white text-sm font-semibold px-4 py-1.5 rounded-full">
                Deskripsi Pustaka Warisan
            </span>

            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">
                Apa Itu Pustaka Warisan?
            </h2>

            <p class="text-lg text-gray-700 leading-relaxed">
                Pustaka Warisan adalah bank data digital yang mengumpulkan, mengkategorikan, dan menyajikan kekayaan Warisan Budaya Indonesia secara komprehensif dan interaktif, menjadikannya sumber referensi yang hidup bagi pelestarian dan pengembangan budaya.
            </p>

            <a href="#" 
               class="inline-block mt-4 bg-[#389A92] hover:bg-[#389A92]/90 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
               Lihat
            </a>

        </div>
    </div>
  </div>
</section>
<!-- end pustaka warisan -->

<!-- jejak maestro -->
<section class="bg-white py-16 sm:py-24 relative overflow-hidden">
  <div class="container mx-auto px-6">
    
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
            Jejak Maestro
        </h1>
    </div>

    <div class="hidden md:block absolute top-1/2 left-0 transform -translate-y-1/2 -translate-x-1/2 -rotate-12 opacity-20 z-0">
         <img src="{{ asset('assets/landing/Patern-wayang-left.png') }}" alt="Dekorasi Warisan" class="w-100 h-auto">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-8 md:gap-12 items-center relative z-10">

        <div class="md:col-span-3 space-y-4 order-2 md:order-1 text-center md:text-left">
            
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">
                Apa Itu Jejak Maestro?
            </h2>

            <p class="text-lg text-gray-700 leading-relaxed">
                Jejak Maestro adalah fitur gamifikasi dalam platform ini yang dirancang untuk mendorong dan memberikan penghargaan kepada pengguna atas kontribusi, partisipasi, dan pencapaian mereka dalam menjelajahi, mempelajari, dan melestarikan warisan budaya.
            </p>
            
            <p class="text-lg text-gray-700 leading-relaxed">
                Fitur ini mengubah proses pembelajaran dan kontribusi menjadi sebuah petualangan yang terstruktur dan menyenangkan.
            </p>

            <div class="flex justify-center md:justify-start">
                <a href="#" 
                   class="inline-block mt-4 bg-[#389A92] hover:bg-[#389A92]/90 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
                   Lihat
                </a>
            </div>

        </div>

        <div class="md:col-span-2 order-1 md:order-2">
            <div class="relative rounded-3xl shadow-2xl overflow-hidden transform transition duration-300 hover:scale-[1.01]">
                <img src="{{ asset('assets/landing/img-jejakmaestro.png') }}" alt="Ilustrasi Jejak Maestro Gamifikasi" class="w-full h-auto object-cover">
            </div>
        </div>

    </div>
  </div>
</section>
 <!--endjejak maestro -->