@extends('admin.AdminLayout')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.categories.index') }}" class="text-[#0F766E] hover:text-[#0F766E]/80">
                <x-heroicon-s-arrow-left class="h-5 w-5" />
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#0F766E]">Tambah Kategori Baru</h1>
                <p class="text-gray-600">Buat kategori baru untuk artikel warisan budaya.</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <!-- Nama Kategori -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                <input type="text" name="name" id="name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]"
                    placeholder="Contoh: Budaya, Sejarah, Tradisi" value="{{ old('name') }}" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0F766E] focus:border-[#0F766E]"
                    placeholder="Jelaskan kategori ini..." required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex gap-4">
                <button type="submit"
                    class="bg-[#0F766E] text-white px-6 py-2 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
                    <x-heroicon-s-check class="h-5 w-5" />
                    Simpan Kategori
                </button>
                <a href="{{ route('admin.categories.index') }}"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
