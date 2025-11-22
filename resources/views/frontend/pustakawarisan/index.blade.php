@extends('frontend.layout.app', ['title' => 'Pustaka Warisan'])
@section('content')
    <!-- Hero Section -->
    <div class="min-h-[45vh] 2xl:min-h-[25vh] flex flex-col items-center justify-center text-center px-6 pt-20 **mt-[-5rem]**" style="background-image: url('{{ asset('assets/landing/background-herosection.png') }}'); background-size: cover; background-repeat: no-repeat; background-position: center; ">
        <img src="{{ asset('assets/landing/logo-herosection.png') }}" alt="">
        <p class="text-white mt-1 p-4 text-l sm:text-xl max-w-screen-xl leading-relaxed">
            Jelajahi akademi literasi digital interaktif, hadapi tantangan Jajak Maestro, dan temukan cara baru berkreasi dari warisan Indonesia. Untuk seluruh pembelajar di Indonesia dan dunia.
        </p>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        {{-- Flash Message untuk Notifikasi Sukses/Gagal --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Pustaka Warisan</h2>
            <div>
                @auth
                    @if(auth()->user()->points >= 150)
                        <a href="{{ route('pustakawarisan.create') }}" class="inline-block px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700 transition">Tulis Artikel</a>
                    @else
                        <span class="text-sm text-gray-600 bg-gray-100 px-3 py-2 rounded">Butuh <strong>150 poin</strong> untuk menulis. Poin Anda: {{ auth()->user()->points ?? 0 }}</span>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="inline-block px-4 py-2 border border-teal-600 text-teal-600 rounded hover:bg-teal-50 transition">Masuk untuk menulis</a>
                @endauth
            </div>
        </div>

        <!-- Search and Filters -->
        <!-- Menggunakan Form GET agar filter bisa diproses di controller nantinya -->
        <form action="{{ route('pustakawarisan.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari di Pustaka Warisan..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <button type="submit" class="absolute right-4 top-3 text-gray-400 hover:text-teal-600">
                        🔍
                    </button>
                </div>
            </div>
            <select name="category" class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">Semua Kategori</option>
                <option value="1">Tarian</option>
                <option value="2">Musik</option>
                <option value="3">Kuliner</option>
            </select>
            <select name="province" class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option value="">Semua Provinsi</option>
                <option value="Aceh">Aceh</option>
                <option value="Jawa Barat">Jawa Barat</option>
                <option value="Bali">Bali</option>
            </select>
        </form>

        <!-- Artikel Budaya Terbaru (Dinamis dari Controller) -->
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-gray-300 pb-2 inline-block">Artikel Budaya Terbaru</h3>
            
            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    @foreach($articles as $article)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow flex flex-col h-full">
                            <div class="relative h-48 shrink-0">
                                {{-- Cek apakah ada gambar, jika tidak pakai placeholder --}}
                                @if($article->img_url)
                                    <img src="{{ asset($article->img_url) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                                @endif
                                
                                {{-- Menampilkan Kategori (Asumsi ada relasi category) --}}
                                <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $article->category->name ?? 'Budaya' }}
                                </span>
                            </div>
                            <div class="p-4 flex flex-col flex-grow">
                                <h4 class="font-bold text-gray-800 mb-2 line-clamp-2 uppercase">{{ $article->title }}</h4>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($article->content), 100) }}
                                </p>
                                <div class="mt-auto">
                                    <a href="{{ route('pustakawarisan.detail', $article->id) }}" class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination Link --}}
                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-lg">
                    <p class="text-gray-500">Belum ada artikel yang tersedia.</p>
                </div>
            @endif
        </div>

        <!-- Budaya Dari Provinsi Anda -->
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-gray-300 pb-2 inline-block">Budaya Dari Provinsi Anda</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="relative h-48">
                        <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Tarian</span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                        <p class="text-gray-600 text-sm mb-4">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                        <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                    </div>
                </a>
                <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="relative h-48">
                        <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Tarian</span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                        <p class="text-gray-600 text-sm mb-4">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                        <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                    </div>
                </a>
                <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="relative h-48">
                        <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Tarian</span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                        <p class="text-gray-600 text-sm mb-4">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                        <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                    </div>
                </a>
                <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="relative h-48">
                        <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Tarian</span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                        <p class="text-gray-600 text-sm mb-4">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                        <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                    </div>
                </a>
            </div>
            <div class="text-center mt-8">
                <button class="px-8 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-semibold">Lebih Banyak</button>
            </div>
        </div>

        <!-- Artikel Budaya Terbaru -->
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-gray-300 pb-2 inline-block">Artikel Budaya Terbaru</h3>
            <div class="relative">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="relative h-48">
                            <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                            <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Tarian</span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-800 mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                            <p class="text-gray-600 text-sm mb-4">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                            <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                        </div>
                    </a>
                    <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="relative h-48">
                            <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                            <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Tarian</span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-800 mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                            <p class="text-gray-600 text-sm mb-4">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                            <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                        </div>
                    </a>
                    <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="relative h-48">
                            <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                            <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Tarian</span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-800 mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                            <p class="text-gray-600 text-sm mb-4">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                            <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                        </div>
                    </a>
                    <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="relative h-48">
                            <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                            <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Tarian</span>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-800 mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                            <p class="text-gray-600 text-sm mb-4">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                            <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Di rekomendasikan Untukmu -->
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-gray-300 pb-2 inline-block">Di rekomendasikan Untukmu</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="relative h-48">
                        <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Tarian</span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                        <p class="text-gray-600 text-sm mb-4">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                        <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                    </div>
                </a>
                <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="relative h-48">
                        <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Tarian</span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                        <p class="text-gray-600 text-sm mb-4">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                        <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                    </div>
                </a>
                <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="relative h-48">
                        <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Tarian</span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                        <p class="text-gray-600 text-sm mb-4">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                        <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                    </div>
                </a>
                <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="relative h-48">
                        <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Tarian</span>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                        <p class="text-gray-600 text-sm mb-4">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                        <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                    </div>
                </a>
            </div>
            <div class="text-center mt-8">
                <button class="px-8 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-semibold">Lebih Banyak</button>
            </div>
        </div>
    </div>
@endsection