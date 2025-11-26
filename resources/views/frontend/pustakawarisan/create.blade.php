@extends('frontend.layout.app', ['title' => 'Tulis Artikel Baru'])

@section('content')
<div class="container mx-auto px-4 py-28">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden">
        <div class="bg-teal-700 px-6 py-4">
            <h2 class="text-2xl font-bold text-white">Tulis Artikel Budaya Baru</h2>
            <p class="text-teal-100 text-sm">Bagikan pengetahuan warisan budaya Anda kepada dunia. Artikel akan melalui proses moderasi.</p>
        </div>

        <div class="p-8">
            <form method="POST" action="{{ route('pustakawarisan.store') }}" enctype="multipart/form-data">
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
                        <input type="file" name="img_url" id="thumbnail" accept="image/*" class="hidden"
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
                    <!-- Provinsi -->
                    <div class="mb-6">
                        <label for="province" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                        <select id="province" class="w-full ...">
                            <option value="">Pilih Provinsi</option>
                        </select>
                        <input type="hidden" name="province" id="province_name">
                    </div>

                    <!-- Kabupaten/Kota -->
                    <div class="mb-6">
                        <label for="regency" class="block text-sm font-medium text-gray-700 mb-2">Kabupaten/Kota</label>
                        <select id="regency" class="w-full ..." disabled>
                            <option value="">Pilih Kabupaten/Kota</option>
                        </select>
                        <input type="hidden" name="regency" id="regency_name">
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]" disabled>
                        <option value="approved" selected>Pending (Auto for User)</option>
                    </select>
                    <input type="hidden" name="status" value="pending">
                    <p class="text-sm text-gray-500 mt-1">Artikel akan Dipending Untuk Mengunggu Persetujuan Admin</p>
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

    </div>
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

        document.addEventListener('DOMContentLoaded', loadProvinces);

        async function loadProvinces(){
            const res = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
            const provinces = await res.json();
            const select = document.getElementById('province');

            provinces.forEach(p=>{
                const option = document.createElement('option');
                option.value = p.id;        // tetap id untuk API
                option.textContent = p.name;
                option.dataset.name = p.name; // simpan nama di dataset
                select.appendChild(option);
            });
        }

        // Saat provinsi dipilih, load kabupaten
        document.getElementById('province').addEventListener('change', async function(){
            const selected = this.selectedOptions[0];
            document.getElementById('province_name').value = selected.dataset.name;

            const regencySelect = document.getElementById('regency');
            regencySelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            regencySelect.disabled = true;

            if(!this.value) return;

            const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${this.value}.json`);
            const regencies = await res.json();

            regencies.forEach(r=>{
                const option = document.createElement('option');
                option.value = r.id;
                option.textContent = r.name;
                option.dataset.name = r.name;
                regencySelect.appendChild(option);
            });

            regencySelect.disabled = false;
        });

        // Saat kabupaten dipilih, simpan nama di hidden input
        document.getElementById('regency').addEventListener('change', function(){
            const selected = this.selectedOptions[0];
            document.getElementById('regency_name').value = selected.dataset.name;
        });
        </script>
@endsection



