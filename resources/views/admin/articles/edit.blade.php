@extends('admin.AdminLayout')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.articles.index') }}" class="text-[#0F766E] hover:text-[#0F766E]/80">
                <x-heroicon-s-arrow-left class="h-5 w-5" />
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#0F766E]">Edit Artikel</h1>
                <p class="text-gray-600">Edit artikel existing.</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel</label>
                <input type="text" name="title" id="title"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]"
                    placeholder="Masukkan judul artikel" value="{{ old('title', $article->title) }}" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Thumbnail -->
            <div class="mb-6">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Thumbnail Artikel</label>
                @if ($article->img_url)
                    <div class="mb-4">
                        <img src="{{ $article->img_url }}" class="h-32 w-auto rounded-lg" alt="Current thumbnail">
                        <p class="text-sm text-gray-500">Thumbnail saat ini</p>
                    </div>
                @endif
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="hidden"
                        onchange="previewImage(this)">
                    <div id="upload-area" onclick="document.getElementById('thumbnail').click()" class="cursor-pointer">
                        <x-heroicon-s-photo class="mx-auto h-12 w-12 text-gray-400" />
                        <p class="mt-2 text-sm text-gray-600">Klik untuk upload gambar baru</p>
                        <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 2MB</p>
                    </div>
                    <div id="image-preview" class="hidden">
                        <img id="preview-img" class="mx-auto h-48 w-auto rounded-lg" />
                        <button type="button" onclick="removeImage()" class="mt-2 text-red-600 text-sm">Hapus</button>
                    </div>
                </div>
                @error('thumbnail')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-6">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="category_id" id="category_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Provinsi & Kabupaten -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="province" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                    <select name="province" id="province"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]"
                        onchange="loadRegencies(this.value)">
                        <option value="">Pilih Provinsi</option>
                    </select>
                    @error('province')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="regency" class="block text-sm font-medium text-gray-700 mb-2">Kabupaten/Kota</label>
                    <select name="regency" id="regency"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]">
                        <option value="">Pilih Kabupaten/Kota</option>
                    </select>
                    @error('regency')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Konten -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Artikel</label>
                <textarea name="content" id="content" rows="10"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]"
                    placeholder="Tulis konten artikel di sini..." required>{{ old('content', $article->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fakta Cepat Terkait -->
            <div class="mb-6">
                <label for="fakta_cepat_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Fakta Cepat Terkait (Opsional)
                </label>
                <select name="fakta_cepat_id" id="fakta_cepat_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]">
                    <option value="">Tidak ada fakta cepat terkait</option>
                    @foreach ($faktaCepats as $faktaCepat)
                        <option value="{{ $faktaCepat->id }}" 
                            {{ old('fakta_cepat_id', $article->fakta_cepat_id) == $faktaCepat->id ? 'selected' : '' }}>
                            {{ $faktaCepat->nama }} - {{ $faktaCepat->asal }}
                        </option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-1">Pilih fakta cepat yang berkaitan dengan artikel ini</p>
                @error('fakta_cepat_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]">
                    <option value="pending" {{ $article->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $article->status === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $article->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <!-- Tombol -->
            <div class="flex gap-4">
                <button type="submit"
                    class="bg-[#0F766E] text-white px-6 py-2 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
                    <x-heroicon-s-check class="h-5 w-5" />
                    Update Artikel
                </button>
                <a href="{{ route('admin.articles.index') }}"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('upload-area').classList.add('hidden');
                    document.getElementById('image-preview').classList.remove('hidden');
                    document.getElementById('preview-img').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            document.getElementById('thumbnail').value = '';
            document.getElementById('upload-area').classList.remove('hidden');
            document.getElementById('image-preview').classList.add('hidden');
        }

        // Load provinces on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadProvinces();
        });

        // Load provinces from API
        async function loadProvinces() {
            try {
                console.log('Loading provinces...');
                const response = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const provinces = await response.json();
                console.log('Provinces data:', provinces);

                const provinceSelect = document.getElementById('province');
                const currentProvince = '{{ old('province', $article->province) }}';

                provinces.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id;
                    option.textContent = province.name;
                    if (province.id == currentProvince) {
                        option.selected = true;
                    }
                    provinceSelect.appendChild(option);
                });

                // Load regencies if province is already selected
                if (currentProvince) {
                    await loadRegencies(currentProvince);
                }

                console.log('Provinces loaded successfully');
            } catch (error) {
                console.error('Error loading provinces:', error);

                // Fallback: add some manual provinces for testing
                const provinceSelect = document.getElementById('province');
                const currentProvince = '{{ old('province', $article->province) }}';
                const fallbackProvinces = [{
                        id: '11',
                        name: 'ACEH'
                    },
                    {
                        id: '12',
                        name: 'SUMATERA UTARA'
                    },
                    {
                        id: '13',
                        name: 'SUMATERA BARAT'
                    },
                    {
                        id: '32',
                        name: 'JAWA BARAT'
                    },
                    {
                        id: '33',
                        name: 'JAWA TENGAH'
                    },
                    {
                        id: '34',
                        name: 'DI YOGYAKARTA'
                    },
                    {
                        id: '35',
                        name: 'JAWA TIMUR'
                    },
                ];

                fallbackProvinces.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id;
                    option.textContent = province.name;
                    if (province.id == currentProvince) {
                        option.selected = true;
                    }
                    provinceSelect.appendChild(option);
                });

                alert('Gagal memuat data provinsi dari API, menggunakan data fallback');
            }
        }

        // Load regencies based on selected province
        async function loadRegencies(provinceCode) {
            const regencySelect = document.getElementById('regency');
            const currentRegency = '{{ old('regency', $article->regency) }}';

            // Clear regency select
            regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            regencySelect.disabled = true;

            if (!provinceCode) return;

            try {
                const response = await fetch(
                    `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceCode}.json`);
                const regencies = await response.json();

                regencies.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.id;
                    option.textContent = regency.name;
                    if (regency.id == currentRegency) {
                        option.selected = true;
                    }
                    regencySelect.appendChild(option);
                });

                regencySelect.disabled = false;
            } catch (error) {
                console.error('Error loading regencies:', error);
            }
        }
    </script>
@endsection
