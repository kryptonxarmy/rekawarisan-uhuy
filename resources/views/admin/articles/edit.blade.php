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
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel</label>
                <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E]">
            </div>

            <!-- Thumbnail -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail Artikel</label>

                @if ($article->img_url)
                    <div class="mb-4">
                        <img src="{{ asset($article->img_url) }}" class="h-32 w-auto rounded-lg">
                        <p class="text-sm text-gray-500">Thumbnail saat ini</p>
                    </div>
                @endif

                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="hidden"
                        onchange="previewImage(this)">

                    <div id="upload-area" onclick="document.getElementById('thumbnail').click()" class="cursor-pointer">
                        <x-heroicon-s-photo class="mx-auto h-12 w-12 text-gray-400" />
                        <p class="mt-2 text-sm text-gray-600">Klik untuk upload gambar baru</p>
                    </div>

                    <div id="image-preview" class="hidden">
                        <img id="preview-img" class="mx-auto h-48 w-auto rounded-lg" />
                        <button type="button" onclick="removeImage()" class="mt-2 text-red-600 text-sm">Hapus</button>
                    </div>
                </div>
            </div>

            <!-- Kategori -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="category_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E]">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Provinsi & Kabupaten -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                    <select name="province" id="province"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E]"
                        onchange="loadRegencies(this.value)">
                        <option value="">Pilih Provinsi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten/Kota</label>
                    <select name="regency" id="regency"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E]">
                        <option value="">Pilih Kabupaten/Kota</option>
                    </select>
                </div>
            </div>

            <!-- Konten -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Konten</label>
                <textarea name="content" rows="10" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E]">{{ old('content', $article->content) }}</textarea>
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E]">
                    <option value="pending" {{ $article->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $article->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $article->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="flex gap-4">
                <button class="bg-[#0F766E] text-white px-6 py-2 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
                    <x-heroicon-s-check class="h-5 w-5" />
                    Update Artikel
                </button>

                <a href="{{ route('admin.articles.index') }}"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Batal</a>
            </div>
        </form>
    </div>

    <script>
        // --- Preview Gambar ---
        function previewImage(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('upload-area').classList.add('hidden');
                    document.getElementById('image-preview').classList.remove('hidden');
                    document.getElementById('preview-img').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            document.getElementById('thumbnail').value = "";
            document.getElementById('upload-area').classList.remove('hidden');
            document.getElementById('image-preview').classList.add('hidden');
        }

        // --- Province & Regency ---
        document.addEventListener('DOMContentLoaded', async function() {
            await loadProvinces('{{ old('province', $article->province) }}');
        });

        async function loadProvinces(selectedProvince = '') {
            const provinceSelect = document.getElementById('province');
            const response = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
            const provinces = await response.json();

            provinces.forEach(p => {
                const option = document.createElement('option');
                option.value = p.name;
                option.textContent = p.name;
                if (p.name === selectedProvince) option.selected = true;
                provinceSelect.appendChild(option);
            });

            if (selectedProvince) {
                loadRegencies(selectedProvince, '{{ old('regency', $article->regency) }}');
            }
        }

        async function loadRegencies(provinceName, selectedRegency = '') {
            const provinceList = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
            const provinces = await provinceList.json();

            const selectedProvince = provinces.find(p => p.name === provinceName);
            if (!selectedProvince) return;

            const regencySelect = document.getElementById('regency');
            regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';

            const response = await fetch(
                `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${selectedProvince.id}.json`
            );

            const regencies = await response.json();

            regencies.forEach(r => {
                const option = document.createElement('option');
                option.value = r.name;
                option.textContent = r.name;
                if (r.name === selectedRegency) option.selected = true;
                regencySelect.appendChild(option);
            });
        }
    </script>
@endsection
