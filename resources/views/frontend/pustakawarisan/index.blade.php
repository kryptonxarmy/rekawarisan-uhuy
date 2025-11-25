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

        <!-- Search & Filter -->
        <form id="filterForm" action="{{ route('pustakawarisan.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-8">
            <!-- Input Search -->
            <div class="flex-1 relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari di Pustaka Warisan..." 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                    id="searchInput"
                >
                <button type="submit" class="absolute right-4 top-3 text-gray-400 hover:text-teal-600">
                    🔍
                </button>
            </div>

            <!-- Filter Kategori -->
            <select name="category" class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" onchange="document.getElementById('filterForm').submit()">
                <option value="">Semua Kategori</option>
                @foreach(App\Models\ArticleCategory::orderBy('name')->get() as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <!-- Filter Provinsi -->
            <select name="province" class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" onchange="document.getElementById('filterForm').submit()">
                <option value="">Semua Provinsi</option>
                @foreach([
                'Aceh',
                'Sumatera Utara',
                'Sumatera Barat',
                'Riau',
                'Jambi',
                'Sumatera Selatan',
                'Bengkulu',
                'Lampung',
                'Kepulauan Bangka Belitung',
                'Kepulauan Riau',
                'DKI Jakarta',
                'Jawa Barat',
                'Jawa Tengah',
                'DI Yogyakarta',
                'Jawa Timur',
                'Banten',
                'Bali',
                'Nusa Tenggara Barat',
                'Nusa Tenggara Timur',
                'Kalimantan Barat',
                'Kalimantan Tengah',
                'Kalimantan Selatan',
                'Kalimantan Timur',
                'Kalimantan Utara',
                'Sulawesi Utara',
                'Sulawesi Tengah',
                'Sulawesi Selatan',
                'Sulawesi Tenggara',
                'Gorontalo',
                'Sulawesi Barat',
                'Maluku',
                'Maluku Utara',
                'Papua',
                'Papua Barat'
            ]
            as $prov)
                    <option value="{{ $prov }}" {{ request('province') == $prov ? 'selected' : '' }}>
                        {{ $prov }}
                    </option>
                @endforeach
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
            @if($provinceArticles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    @foreach($provinceArticles as $article)
                        <a href="{{ route('pustakawarisan.detail', $article->id) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="relative h-48">
                                @if($article->img_url)
                                    <img src="{{ asset($article->img_url) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                                @endif
                                <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $article->category->name ?? 'Budaya' }}
                                </span>
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold text-gray-800 mb-2 line-clamp-2 uppercase">{{ $article->title }}</h4>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                                <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="{{ route('pustakawarisan.index') }}?province={{ auth()->user()->province }}" class="px-8 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-semibold">Lebih Banyak</a>
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-lg">
                    <p class="text-gray-500">Belum ada artikel untuk provinsi Anda.</p>
                </div>
            @endif
        </div>

        <!-- Artikel Budaya Terfavorit -->
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-gray-300 pb-2 inline-block">Artikel Budaya Terfavorit</h3>
            @if($favoriteArticles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    @foreach($favoriteArticles as $article)
                        <a href="{{ route('pustakawarisan.detail', $article->id) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="relative h-48">
                                @if($article->img_url)
                                    <img src="{{ asset($article->img_url) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                                @endif
                                <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $article->category->name ?? 'Budaya' }}
                                </span>
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold text-gray-800 mb-2 line-clamp-2 uppercase">{{ $article->title }}</h4>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                                <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-lg">
                    <p class="text-gray-500">Belum ada artikel favorit.</p>
                </div>
            @endif
        </div>

        <!-- Di Rekomendasikan Untukmu -->
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-gray-300 pb-2 inline-block">Di Rekomendasikan Untukmu</h3>
            @if($recommendedArticles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    @foreach($recommendedArticles as $article)
                        <a href="{{ route('pustakawarisan.detail', $article->id) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="relative h-48">
                                @if($article->img_url)
                                    <img src="{{ asset($article->img_url) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                                @endif
                                <span class="absolute top-3 left-3 bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $article->category->name ?? 'Budaya' }}
                                </span>
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold text-gray-800 mb-2 line-clamp-2 uppercase">{{ $article->title }}</h4>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                                <button class="text-teal-600 font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="{{ route('pustakawarisan.index') }}" class="px-8 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-semibold">Lebih Banyak</a>
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-lg">
                    <p class="text-gray-500">Belum ada rekomendasi untukmu.</p>
                </div>
            @endif
        </div>

    </div>

    <script>
         // Fungsi debounce untuk mencegah submit terlalu cepat
        function debounce(func, delay) {
            let timeout;
            return function() {
                const context = this;
                const args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), delay);
            };
        }

        const searchInput = document.getElementById('searchInput');
        const filterForm = document.getElementById('filterForm');

        searchInput.addEventListener('input', debounce(function() {
            filterForm.submit();
        }, 200)); // delay 500ms setelah user berhenti mengetik
    </script>
@endsection