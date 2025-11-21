@extends('frontend.layout.app', ['title' => 'Pustaka Warisan'])
@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-teal-700 to-teal-600 py-16">
        <div class="container mx-auto px-4 text-center">
            <img src="{{ asset('images/rekawarisan_removebgpreview.png') }}" alt="Reka Warisan" class="mx-auto mb-4 h-36 md:h-48 lg:h-64" style="max-width:720px; width:auto; filter: drop-shadow(4px 4px 8px rgba(0,0,0,0.45));">
            <p class="text-white text-lg max-w-4xl mx-auto">
                Jelajahi akademi literasi digital interaktif, hadapi tantangan Jajak Maestro, dan temukan cara baru berkreasi dari warisan Indonesia. Untuk seluruh pembelajar di Indonesia dan dunia.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Pustaka Warisan</h2>
            <div>
                @auth
                    @if(auth()->user()->points >= 150)
                        <a href="{{ route('articles.create') }}" class="inline-block px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">Tulis Artikel</a>
                    @else
                        <span class="text-sm text-gray-600">Butuh <strong>150 poin</strong> untuk menulis. Anda punya: {{ auth()->user()->points ?? 0 }}</span>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="inline-block px-4 py-2 border border-teal-600 text-teal-600 rounded">Masuk untuk menulis</a>
                @endauth
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" placeholder="Search For Pustaka Warisan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <span class="absolute right-4 top-3 text-gray-400">🔍</span>
                </div>
            </div>
            <select class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option>Kategori</option>
                <option>Tarian</option>
                <option>Musik</option>
                <option>Kuliner</option>
            </select>
            <select class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                <option>Provinsi</option>
                <option>Aceh</option>
                <option>Jawa Barat</option>
                <option>Bali</option>
            </select>
        </div>

        <!-- Sedang Populer Section -->
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-gray-300 pb-2 inline-block">Sedang Populer</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                <a href="{{ route('pustakawarisan.detail') }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
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