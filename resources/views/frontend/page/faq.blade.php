@extends('frontend.layout.app', ['title' => 'FAQ'])

@section('content')

     <!-- hero section -->
    <div class="min-h-[30vh] flex flex-col px-6 pt-20 **mt-[-5rem]**" style="background-image: url('{{ asset('assets/landing/background-herosection.png') }}'); background-size: cover; background-repeat: no-repeat; background-position: center; ">
        <div class="container mt-5 p-4 relative z-10">
            
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-3">
                Frequently Asked Questions
            </h1>

            <div class="text-sm font-semibold text-white/80">
                <a href="{{ route('beranda') }}" class="hover:underline text-yellow-300">Home</a>
                <span class="mx-2">&gt;</span>
                <span>FAQ</span>
            </div>
            
        </div>
    </div>
    <!-- end -->

<!-- faq -->
<section class="py-16 sm:py-24 bg-gradient-to-br from-gray-50 to-white">
    <div class="container mx-auto px-6 max-w-4xl">
        <!-- Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-3 bg-[#127E80]/10 text-[#127E80] text-sm font-semibold px-6 py-3 rounded-full border border-[#127E80]/20 mb-6">
                <div class="w-2 h-2 bg-[#127E80] rounded-full animate-pulse"></div>
                Bantuan & Dukungan
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Pertanyaan yang Sering Diajukan
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Temukan jawaban untuk pertanyaan umum seputar platform Reka Warisan dan fitur-fiturnya.
            </p>
        </div>

        <!-- FAQ Accordion dengan Flowbite -->
        <div id="accordion-collapse" data-accordion="collapse" class="space-y-4">
            
        <div class="1">
            <!-- Question 1 -->
            <h2 id="accordion-collapse-heading-1">
                <button type="button" class="flex items-center justify-between w-full p-6 font-medium bg-white border border-gray-200 rounded-2xl hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 transition-all duration-300" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                    <span class="text-lg text-[#127E80] font-semibold">Apa itu Reka Warisan dan apa tujuannya?</span>
                    <svg data-accordion-icon class="w-5 h-5 text-[#127E80] shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                <div class="p-6 border border-t-0 border-gray-200 rounded-b-2xl bg-white">
                    <p class="text-gray-700 leading-relaxed">
                        <strong>Reka Warisan</strong> adalah platform digital inovatif yang bertujuan melestarikan dan mempromosikan warisan budaya Indonesia melalui teknologi. Kami menghubungkan kekayaan tradisi dengan ekonomi digital global, menyediakan akses terhadap pengetahuan budaya, dan menciptakan peluang ekonomi berkelanjutan bagi pelaku seni dan budaya.
                    </p>
                </div>
            </div>
        </div>

        <div class="2">
            <!-- Question 2 -->
            <h2 id="accordion-collapse-heading-2">
                <button type="button" class="flex items-center justify-between w-full p-6 font-medium text-gray-900 bg-white border border-gray-200 rounded-2xl hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 transition-all duration-300" data-accordion-target="#accordion-collapse-body-2" aria-expanded="false" aria-controls="accordion-collapse-body-2">
                    <span class="text-lg text-[#127E80] font-semibold">Bagaimana cara menggunakan Pustaka Warisan?</span>
                    <svg data-accordion-icon class="w-5 h-5 text-[#127E80] shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
                <div class="p-6 border border-t-0 border-gray-200 rounded-b-2xl bg-white">
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Menggunakan Pustaka Warisan sangat mudah:
                    </p>
                    <ul class="text-gray-700 space-y-2 list-disc list-inside">
                        <li><strong>Daftar akun</strong> gratis di platform Reka Warisan</li>
                        <li><strong>Jelajahi koleksi</strong> menggunakan fitur pencarian atau kategori</li>
                        <li><strong>Filter hasil</strong> berdasarkan jenis warisan, daerah, atau periode</li>
                        <li><strong>Simpan favorit</strong> untuk akses cepat di kemudian hari</li>
                        <li><strong>Download materi</strong> yang tersedia untuk studi atau referensi</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="3">
            <!-- Question 3 -->
            <h2 id="accordion-collapse-heading-3">
                <button type="button" class="flex items-center justify-between w-full p-6 font-medium text-gray-900 bg-white border border-gray-200 rounded-2xl hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 transition-all duration-300" data-accordion-target="#accordion-collapse-body-3" aria-expanded="false" aria-controls="accordion-collapse-body-3">
                    <span class="text-lg text-[#127E80] font-semibold">Apa itu Jejak Maestro dan bagaimana sistem levelnya bekerja?</span>
                    <svg data-accordion-icon class="w-5 h-5 text-[#127E80] shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-3" class="hidden" aria-labelledby="accordion-collapse-heading-3">
                <div class="p-6 border border-t-0 border-gray-200 rounded-b-2xl bg-white">
                    <p class="text-gray-700 leading-relaxed mb-4">
                        <strong>Jejak Maestro</strong> adalah fitur gamifikasi yang membuat pembelajaran warisan budaya menjadi menyenangkan. Sistem levelnya bekerja berdasarkan:
                    </p>
                    <ul class="text-gray-700 space-y-2 list-disc list-inside">
                        <li><strong>Poin Pengalaman (XP)</strong> - Dapatkan dengan menyelesaikan quest dan aktivitas</li>
                        <li><strong>Level Progresi</strong> - Naik level setiap kali mencapai XP tertentu</li>
                        <li><strong>Badge & Achievement</strong> - Koleksi penghargaan untuk pencapaian spesifik</li>
                        <li><strong>Leaderboard</strong> - Bandingkan progres dengan pengguna lain</li>
                        <li><strong>Quest Harian/Mingguan</strong> - Tantangan reguler untuk mendapatkan bonus XP</li>
                    </ul>
                </div>
            </div>           
        </div>

        <div class="4">
            <!-- Question 4 -->
            <h2 id="accordion-collapse-heading-4">
                <button type="button" class="flex items-center justify-between w-full p-6 font-medium text-gray-900 bg-white border border-gray-200 rounded-2xl hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 transition-all duration-300" data-accordion-target="#accordion-collapse-body-4" aria-expanded="false" aria-controls="accordion-collapse-body-4">
                    <span class="text-lg text-[#127E80] font-semibold">Apakah ada biaya untuk menggunakan platform Reka Warisan?</span>
                    <svg data-accordion-icon class="w-5 h-5 text-[#127E80] shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-4" class="hidden" aria-labelledby="accordion-collapse-heading-4">
                <div class="p-6 border border-t-0 border-gray-200 rounded-b-2xl bg-white">
                    <p class="text-gray-700 leading-relaxed">
                        <strong>Akses dasar ke platform Reka Warisan sepenuhnya gratis!</strong> Anda dapat:
                    </p>
                    <ul class="text-gray-700 space-y-2 list-disc list-inside mt-3">
                        <li>Membuat akun gratis</li>
                        <li>Mengakses Pustaka Warisan dasar</li>
                        <li>Berpartisipasi dalam Jejak Maestro</li>
                        <li>Menjelajahi konten budaya yang tersedia</li>
                    </ul>
                    <p class="text-gray-700 mt-3">
                        Untuk fitur premium seperti akses ke konten eksklusif, download resolusi tinggi, dan fitur lanjutan, kami menyediakan paket berlangganan dengan harga terjangkau.
                    </p>
                </div>
            </div>
        </div>

        <div class="5">
            <!-- Question 5 -->
            <h2 id="accordion-collapse-heading-5">
                <button type="button" class="flex items-center justify-between w-full p-6 font-medium text-gray-900 bg-white border border-gray-200 rounded-2xl hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 transition-all duration-300" data-accordion-target="#accordion-collapse-body-5" aria-expanded="false" aria-controls="accordion-collapse-body-5">
                    <span class="text-lg text-[#127E80] font-semibold">Bagaimana cara berkontribusi menambah konten ke platform?</span>
                    <svg data-accordion-icon class="w-5 h-5 text-[#127E80] shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-5" class="hidden" aria-labelledby="accordion-collapse-heading-5">
                <div class="p-6 border border-t-0 border-gray-200 rounded-b-2xl bg-white">
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Kami sangat menyambut kontribusi dari komunitas! Berikut cara berkontribusi:
                    </p>
                    <ul class="text-gray-700 space-y-2 list-disc list-inside">
                        <li><strong>Submit Konten</strong> - Gunakan form "Kirim Kontribusi" di dashboard</li>
                        <li><strong>Verifikasi</strong> - Tim kami akan memverifikasi keaslian dan akurasi konten</li>
                        <li><strong>Atribusi</strong> - Nama Anda akan tercantum sebagai kontributor</li>
                        <li><strong>Reward</strong> - Dapatkan poin Jejak Maestro untuk setiap kontribusi yang diterima</li>
                    </ul>
                    <p class="text-gray-700 mt-3">
                        Jenis konten yang dapat dikontribusikan: foto, video, artikel, dokumentasi tradisi, resep masakan tradisional, dan lain-lain.
                    </p>
                </div>
            </div>
        </div>

        </div>

        <!-- CTA Section -->
        <div class="text-center mt-12 pt-8 border-t border-gray-200">
            <p class="text-gray-600 mb-6">Masih ada pertanyaan?</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 bg-[#127E80] hover:bg-[#0F6B6E] text-white font-semibold py-3 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Hubungi Tim Support
            </a>
        </div>
    </div>
</section>
<!-- end faq -->
@endsection