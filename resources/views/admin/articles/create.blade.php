@extends('admin.AdminLayout')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.articles.index') }}" class="text-[#0F766E] hover:text-[#0F766E]/80">
                <x-heroicon-s-arrow-left class="h-5 w-5" />
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#0F766E]">Tambah Artikel Baru</h1>
                <p class="text-gray-600">Buat artikel baru sebagai admin.</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Judul -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel</label>
                <input type="text" name="title" id="title"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]"
                    placeholder="Masukkan judul artikel" 
                    value="{{ old('title') }}" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Thumbnail -->
            <div class="mb-6">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Thumbnail Artikel</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="hidden"
                        onchange="previewImage(this)">
                    <div id="upload-area" onclick="document.getElementById('thumbnail').click()" class="cursor-pointer">
                        <x-heroicon-s-photo class="mx-auto h-12 w-12 text-gray-400" />
                        <p class="mt-2 text-sm text-gray-600">Klik untuk upload gambar</p>
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
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konten -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Artikel</label>
                <textarea name="content" id="content" rows="10"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]"
                    placeholder="Tulis konten artikel di sini..." required>{{ old('content') }}</textarea>
                @error('content')
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
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]"
                        disabled>
                        <option value="">Pilih Kabupaten/Kota</option>
                    </select>
                    @error('regency')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]" disabled>
                    <option value="approved" selected>Approved (Auto for Admin)</option>
                </select>
                <input type="hidden" name="status" value="approved">
                <p class="text-sm text-gray-500 mt-1">Artikel admin otomatis di-approve</p>
            </div>

            <!-- Tombol -->
            <div class="flex gap-4">
                <button type="submit"
                    class="bg-[#0F766E] text-white px-6 py-2 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
                    <x-heroicon-s-check class="h-5 w-5" />
                    Simpan Artikel
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

                provinces.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.name;
                    option.textContent = province.name;
                    provinceSelect.appendChild(option);
                });

                console.log('Provinces loaded successfully');
            } catch (error) {
                console.error('Error loading provinces:', error);

                // Fallback: add some manual provinces for testing
                const provinceSelect = document.getElementById('province');
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
                    provinceSelect.appendChild(option);
                });
            }
        }

        // Load regencies based on selected province
        async function loadRegencies(provinceCode) {
            const regencySelect = document.getElementById('regency');

            // Clear and disable regency select
            regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            regencySelect.disabled = true;

            if (!provinceCode) return;

            try {
                console.log('Loading regencies for province:', provinceCode);
                const response = await fetch(
                    `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceCode}.json`);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const regencies = await response.json();
                console.log('Regencies data:', regencies);

                regencies.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.name;
                    option.textContent = regency.name;
                    regencySelect.appendChild(option);
                });

                regencySelect.disabled = false;
                console.log('Regencies loaded successfully');
            } catch (error) {
                console.error('Error loading regencies:', error);

                // Fallback data for testing (based on common regencies)
                const fallbackRegencies = [{
                        id: '1101',
                        name: 'KABUPATEN SIMEULUE'
                    },
                    {
                        id: '1102',
                        name: 'KABUPATEN ACEH SINGKIL'
                    },
                    {
                        id: '1103',
                        name: 'KABUPATEN ACEH SELATAN'
                    },
                    {
                        id: '1171',
                        name: 'KOTA BANDA ACEH'
                    },
                    {
                        id: '1201',
                        name: 'KABUPATEN NIAS'
                    },
                    {
                        id: '1202',
                        name: 'KABUPATEN MANDAILING NATAL'
                    },
                ];

                fallbackRegencies.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.id;
                    option.textContent = regency.name;
                    regencySelect.appendChild(option);
                });

                regencySelect.disabled = false;
            }
        }
    </script>
@endsection
