@extends('frontend.layout.app', ['title' => 'Contact'])

@section('content')
<div class="bg-gray-100 min-h-screen">

    <!-- hero section -->
    <div class="min-h-[30vh] xl:min-h-[25vh] 2xl:min-h-[15vh] flex flex-col px-6 pt-20" style="background-image: url('{{ asset('assets/landing/background-herosection.png') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;">
        <div class="container mt-5 p-4 relative z-10">
            <h1 class="text-3xl font-bold text-white tracking-tight">HUBUNGI KAMI</h1>
            <div class="text-sm font-semibold text-white/80 mt-1">
                <a href="{{ route('beranda') }}" class="hover:underline text-yellow-300">Home</a>
                <span class="mx-1">&gt;</span>
                <span>Hubungi kami</span>
            </div>
        </div>
    </div>

    <main class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Contact Info Cards -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Lokasi Card -->
                <div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-2xl border border-[#389A92]/20 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#389A92] to-[#2D7A74] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.828a2 2 0 01-2.828 0L6.343 16.657A8 8 0 1117.657 16.657z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900 text-lg mb-2">Lokasi</p>
                            <p class="text-gray-700 font-medium">Desa Mungggugebang</p>
                            <p class="text-gray-600 text-sm">Kecamatan Banyeng, Kabupaten Gresik</p>
                        </div>
                    </div>
                </div>

                <!-- Email Card -->
                <div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-2xl border border-[#389A92]/20 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-yellow-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900 text-lg mb-2">E-mail Address</p>
                            <p class="text-gray-700 font-medium">rekawarisan@gmail.com</p>
                            <p class="text-gray-600 text-sm">Response within 24 hours</p>
                        </div>
                    </div>
                </div>

                <!-- Additional Info Card -->
                <div class="bg-gradient-to-br from-[#389A92]/5 to-[#2D7A74]/10 p-6 rounded-2xl border border-[#389A92]/30 shadow-lg">
                    <div class="text-center space-y-3">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#389A92] to-[#2D7A74] rounded-full flex items-center justify-center mx-auto shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">Quick Response</h3>
                        <p class="text-gray-600 text-sm">Kami akan membalas pesan Anda dalam waktu 1x24 jam</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2 bg-gradient-to-br from-white to-gray-50 p-8 rounded-2xl border border-gray-200 shadow-2xl hover:shadow-2xl transition-all duration-300">

                <!-- Header -->
                <div class="flex items-center mb-8 pb-6 border-b border-gray-200">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#389A92] to-[#2D7A74] rounded-xl flex items-center justify-center shadow-lg mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Tulis Pesan</h2>
                        <div class="w-16 h-1 bg-gradient-to-r from-[#389A92] to-[#2D7A74] rounded-full mt-2"></div>
                    </div>
                </div>

                <!-- Flash Message -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl border-l-4 border-green-500">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Description -->
                <p class="text-gray-700 text-lg mb-8 leading-relaxed bg-[#389A92]/5 p-4 rounded-xl border-l-4 border-[#389A92]">
                    Masukkan, kritik, dan saran Anda sangat berarti bagi kami. Bantu Reka Warisan untuk terus berkembang dengan membagikan pengalaman dan pemikiran Anda melalui formulir di bawah ini.
                </p>

                <!-- Form -->
                <form id="contactForm" class="space-y-6" method="POST" action="{{ route('contacts.store') }}">
                    @csrf

                    <!-- Nama -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" placeholder="Masukkan nama lengkap Anda" 
                            class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#389A92] focus:border-[#389A92] transition-all duration-300 group-hover:border-[#389A92]/50 bg-white shadow-sm" required>
                    </div>

                    <!-- Email & Telepon -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                            <input type="email" name="email" placeholder="email@contoh.com" 
                                class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#389A92] focus:border-[#389A92] transition-all duration-300 group-hover:border-[#389A92]/50 bg-white shadow-sm" required>
                        </div>
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" name="phone" placeholder="08xx xxxx xxxx" 
                                class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#389A92] focus:border-[#389A92] transition-all duration-300 group-hover:border-[#389A92]/50 bg-white shadow-sm">
                        </div>
                    </div>

                    <!-- Pesan -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Pesan</label>
                        <textarea name="message" placeholder="Tulis pesan, kritik, atau saran Anda di sini..." rows="6"
                                class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#389A92] focus:border-[#389A92] transition-all duration-300 group-hover:border-[#389A92]/50 bg-white shadow-sm resize-none" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-[#389A92] to-[#2D7A74] hover:from-[#2D7A74] hover:to-[#389A92] text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 border border-[#389A92]/20 group relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -skew-x-12 transform translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                        <span class="flex items-center justify-center gap-3 text-lg relative z-10">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Kirim Pesan
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection
