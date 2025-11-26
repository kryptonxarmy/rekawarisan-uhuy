@extends('admin.AdminLayout')

@section('content')
    <div class="mb-8">
        </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.badges.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Badge</label>
                <input type="text" name="name" id="name" class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]" value="{{ old('name') }}" required>
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="3" class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]" required>{{ old('description') }}</textarea>
                @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="points_requirement" class="block text-sm font-medium text-gray-700 mb-2">Syarat Poin Minimum</label>
                <input type="number" name="points_requirement" id="points_requirement" class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]" value="{{ old('points_requirement') }}" min="0" required>
                @error('points_requirement') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Badge</label>
                <input type="file" name="image" id="image" class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E] p-2" accept="image/*" required>
                @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.badges.index') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition-colors">Batal</a>
                <button type="submit" class="bg-[#0F766E] text-white px-6 py-3 rounded-lg hover:bg-[#0F766E]/90 transition-colors">Buat Badge</button>
            </div>
        </form>
    </div>
@endsection