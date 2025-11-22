@extends('frontend.layout.app', ['title' => 'Tulis Artikel Baru'])

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden">
        <div class="bg-teal-700 px-6 py-4">
            <h2 class="text-2xl font-bold text-white">Tulis Artikel Budaya Baru</h2>
            <p class="text-teal-100 text-sm">Bagikan pengetahuan warisan budaya Anda kepada dunia. Artikel akan melalui proses moderasi.</p>
        </div>

        <form id="articleForm" action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf

            {{-- Judul Artikel --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-teal-500 focus:border-teal-500 @error('title') border-red-500 @else border-gray-300 @enderror"
                    placeholder="Contoh: Tari Saman - Budaya Suku Gayo Aceh">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Kategori --}}
                <select name="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $article->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>


                {{-- Gambar Utama --}}
                <div>
                    <label for="img_url" class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama Artikel <span class="text-gray-400 text-xs">(Max 5MB)</span></label>
                    <input type="file" name="img_url" id="img_url" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 border border-gray-300 rounded-lg">
                    @error('img_url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Provinsi --}}
                <div>
                    <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Provinsi Asal</label>
                    {{-- CATATAN: Provinsi ini harusnya didapat dari database --}}
                    <select name="province" id="province" class="w-full px-4 py-2 border rounded-lg focus:ring-teal-500 focus:border-teal-500 border-gray-300">
                        <option value="">Pilih Provinsi</option>
                        <option value="Aceh" {{ old('province') == 'Aceh' ? 'selected' : '' }}>Aceh</option>
                        <option value="Jawa Barat" {{ old('province') == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                        <option value="Bali" {{ old('province') == 'Bali' ? 'selected' : '' }}>Bali</option>
                        <option value="DKI Jakarta" {{ old('province') == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                    </select>
                </div>

                {{-- Kota/Kabupaten --}}
                <div>
                    <label for="regency" class="block text-sm font-medium text-gray-700 mb-1">Kota/Kabupaten</label>
                    <input type="text" name="regency" id="regency" value="{{ old('regency') }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500"
                        placeholder="Contoh: Banda Aceh">
                </div>
            </div>

            {{-- Isi Artikel --}}
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
                    Isi Artikel <span class="text-red-500">*</span>
                    <span class="text-xs text-gray-500">(Min 50 karakter. Anda dapat menambahkan gambar dengan tag HTML.)</span>
                </label>

                <textarea 
                    name="content" 
                    id="content"
                    rows="8"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                    placeholder="Tuliskan isi artikel di sini... (boleh pakai HTML seperti <img> atau <p>)"
                >{{ old('content') }}</textarea>

                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Submit --}}
            <div class="flex items-center justify-end gap-4 pt-4 border-t">
                <a href="{{ route('pustakawarisan.index') }}" class="px-6 py-2 text-gray-600 hover:text-gray-800 font-medium">Batal</a>
                <button type="submit" class="px-8 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 shadow-md transition duration-200 font-semibold">
                    Kirim Artikel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

