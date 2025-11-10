@extends('frontend.layout.app', ['title' => 'Contact'])
@section('content')
 <div class="bg-gray-100 min-h-screen">
    
    <header class="relative py-8 bg-[#145D63] overflow-hidden">
        <div class="absolute inset-0 opacity-50 z-0" 
             style="background-image: url('https://via.placeholder.com/1000x300.png?text=Pola+Batik+Teal'); background-repeat: repeat; background-size: 200px;">
        </div>
        
        <div class="container mx-auto px-6 relative z-10">
            <h1 class="text-3xl font-bold text-white tracking-tight">HUBUNGI KAMI</h1>
            <div class="text-sm font-semibold text-white/80 mt-1">
                <a href="{{ route('beranda') }}" class="hover:underline text-yellow-300">Home</a>
                <span class="mx-1">&gt;</span>
                <span>Hubungi kami</span>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-white p-6 rounded-xl border border-[#389A92]/40 shadow-sm">
                    <div class="flex items-start space-x-3">
                        <div class="mt-1">
                            <svg class="w-6 h-6 text-[#389A92]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.828a2 2 0 01-2.828 0L6.343 16.657A8 8 0 1117.657 16.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Lokasi</p>
                            <p class="text-sm text-gray-600">Desa Mungggulgebang</p>
                            <p class="text-sm text-gray-600">Kecamatan Banyeng, Kabupaten Gresik</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-[#389A92]/40 shadow-sm">
                    <div class="flex items-start space-x-3">
                        <div class="mt-1">
                            <svg class="w-6 h-6 text-[#389A92]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">E-mail Address</p>
                            <p class="text-sm text-gray-600">rekawarisan@gmail.com</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-2 bg-white p-8 rounded-xl border border-gray-200 shadow-xl">
                <div class="flex items-center mb-6">
                    <svg class="w-6 h-6 text-gray-900 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    <h2 class="text-2xl font-bold text-gray-900">Tulis Pesan</h2>
                </div>
                
                <p class="text-gray-600 mb-6">
                    Masukkan, kritik, dan saran Anda sangat berarti bagi kami. Bantu Reka Warisan untuk terus berkembang dengan membagikan pengalaman dan pemikiran Anda melalui formulir di bawah ini.
                </p>

                <form class="space-y-4">
                    <div>
                        <input type="text" placeholder="Nama" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-[#389A92] focus:border-[#389A92]">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="email" placeholder="Email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-[#389A92] focus:border-[#389A92]">
                        <input type="tel" placeholder="Nomor Telepon" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-[#389A92] focus:border-[#389A92]">
                    </div>

                    <div>
                        <textarea placeholder="Isi Pesan" rows="7" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-[#389A92] focus:border-[#389A92]"></textarea>
                    </div>

                    <button type="submit" class="bg-[#389A92] hover:bg-[#389A92]/90 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-md">
                        Kirim
                    </button>
                </form>
            </div>

        </div>
    </main>
</div>
@endsection