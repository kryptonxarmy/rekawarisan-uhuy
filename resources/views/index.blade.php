<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustaka Warisan - Reka Warisan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-8">
                    <div class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold">
                            R
                        </div>
                    </div>
                    <div class="hidden md:flex space-x-6">
                        <a href="#" class="text-gray-700 hover:text-teal-600">Beranda</a>
                        <a href="#" class="text-teal-600 font-semibold border-b-2 border-teal-600">Pustaka Warisan</a>
                        <a href="#" class="text-gray-700 hover:text-teal-600">Jajak Maestro</a>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">Masuk</button>
                    <button class="px-6 py-2 border-2 border-teal-600 text-teal-600 rounded-lg hover:bg-teal-50">Daftar</button>
                </div>
            </div>
        </div>
    </nav>

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
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Pustaka Warisan</h2>

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

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                            <span class="text-teal-600 font-bold text-xl">R</span>
                        </div>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Reka Warisan</h3>
                    <p class="text-gray-400 text-sm">Jembatan inovasi dengan Budaya ke Ekonomi Digital Global. Platform terintegrasi untuk kolaborasi dan literasi digital warisan Nusantara.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">NAVIGASI CEPAT</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Beranda</a></li>
                        <li><a href="#" class="hover:text-white">Pustaka Warisan</a></li>
                        <li><a href="#" class="hover:text-white">Jajak Maestro</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">INFORMASI HUKUM & DUKUNGAN</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Hubungi Kami</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">NEWSLETTER</h4>
                    <div class="flex">
                        <input type="email" placeholder="Masukkan alamat email Anda" class="flex-1 px-4 py-2 rounded-l-lg text-gray-900 focus:outline-none">
                        <button class="bg-teal-600 px-4 py-2 rounded-r-lg hover:bg-teal-700">→</button>
                    </div>
                    <p class="text-gray-400 text-sm mt-4">Berlangganan Sekarang</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 flex justify-between items-center">
                <p class="text-gray-400 text-sm">@2025 Reka Warisan. All Right Reserved</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white">🐦</a>
                    <a href="#" class="text-gray-400 hover:text-white">📘</a>
                    <a href="#" class="text-gray-400 hover:text-white">📷</a>
                    <a href="#" class="text-gray-400 hover:text-white">🔗</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>