@extends('admin.AdminLayout')

@section('content')
<div class="mb-8">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.badges.index') }}" class="text-gray-500 hover:text-gray-700">
            <x-heroicon-s-arrow-left class="h-6 w-6" /> 
        </a>
        <div>
            <h1 class="text-3xl font-bold text-[#0F766E]">Edit Badge: {{ $badge->name }}</h1>
            <p class="text-gray-600 mt-2">Perbarui data dan syarat badge</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.badges.update', $badge->id) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-6">
          
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Badge</label>
            <input type="text" name="name" id="name" value="{{ old('name', $badge->name) }}" 
                   class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]" required>
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="3" 
                      class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]" required>{{ old('description', $badge->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="points_requirement" class="block text-sm font-medium text-gray-700 mb-2">Syarat Poin Minimum</label>
            <input type="number" name="points_requirement" id="points_requirement" value="{{ old('points_requirement', $badge->points_requirement) }}"
                   class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]" required min="0">
            <p class="mt-1 text-sm text-gray-500">Jumlah poin minimum user untuk mendapatkan badge ini.</p>
            @error('points_requirement')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        @if($badge->image)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Sekarang</label>
            <img src="{{ Storage::url($badge->image) }}" 
                 alt="Gambar Badge {{ $badge->name }}" 
                 class="h-20 w-20 object-cover rounded-lg border mb-3">
        </div>
        @endif

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Ganti Gambar (opsional)</label>
            <input type="file" name="image" id="image" 
                   class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E] p-2"
                   accept="image/*">
            <p class="mt-1 text-sm text-gray-500">Unggah gambar baru (PNG/JPG/SVG, maks 2MB) jika ingin mengganti.</p>
            @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-[#0F766E] text-white px-6 py-3 rounded-lg hover:bg-[#0F766E]/90 transition-colors">
                Update Badge
            </button>
        </div>
    </form>
</div>
@endsection