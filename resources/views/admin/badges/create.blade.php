@extends('admin.AdminLayout')

@section('content')
    <div class="mb-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.badges.index') }}" class="text-gray-500 hover:text-gray-700">
                <x-heroicon-s-arrow-left class="h-6 w-6" />
            </a>
            <div>
                <h1 class="text-3xl font-bold text-[#0F766E]">Buat Badge Baru</h1>
                <p class="text-gray-600 mt-2">Buat badge penghargaan untuk sistem gamifikasi</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.badges.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Badge Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Badge</label>
                <input type="text" name="name" id="name" 
                       class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]"
                       placeholder="Contoh: Pelestari Warisan"
                       value="{{ old('name') }}" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]"
                          placeholder="Deskripsi badge dan maknanya"
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Requirements -->
            <div>
                <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Syarat Mendapatkan Badge</label>
                <textarea name="requirements" id="requirements" rows="2"
                          class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]"
                          placeholder="Contoh: Selesaikan 5 misi harian berturut-turut"
                          required>{{ old('requirements') }}</textarea>
                @error('requirements')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Icon Selection -->
                <div>
                    <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon Badge</label>
                    <select name="icon" id="icon" 
                            class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]"
                            required>
                        <option value="">Pilih Icon</option>
                        <option value="star" {{ old('icon') == 'star' ? 'selected' : '' }}>⭐ Bintang</option>
                        <option value="trophy" {{ old('icon') == 'trophy' ? 'selected' : '' }}>🏆 Trofi</option>
                        <option value="book-open" {{ old('icon') == 'book-open' ? 'selected' : '' }}>📖 Buku</option>
                        <option value="shield" {{ old('icon') == 'shield' ? 'selected' : '' }}>🛡️ Perisai</option>
                        <option value="fire" {{ old('icon') == 'fire' ? 'selected' : '' }}>🔥 Api</option>
                    </select>
                    @error('icon')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Color Selection -->
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Warna Badge</label>
                    <select name="color" id="color" 
                            class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]"
                            required>
                        <option value="">Pilih Warna</option>
                        <option value="#10B981" {{ old('color') == '#10B981' ? 'selected' : '' }}>🟢 Hijau</option>
                        <option value="#3B82F6" {{ old('color') == '#3B82F6' ? 'selected' : '' }}>🔵 Biru</option>
                        <option value="#F59E0B" {{ old('color') == '#F59E0B' ? 'selected' : '' }}>🟡 Kuning</option>
                        <option value="#EF4444" {{ old('color') == '#EF4444' ? 'selected' : '' }}>🔴 Merah</option>
                        <option value="#8B5CF6" {{ old('color') == '#8B5CF6' ? 'selected' : '' }}>🟣 Ungu</option>
                        <option value="#06B6D4" {{ old('color') == '#06B6D4' ? 'selected' : '' }}>🔵 Cyan</option>
                    </select>
                    @error('color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- XP Reward -->
            <div>
                <label for="xp_reward" class="block text-sm font-medium text-gray-700 mb-2">XP Reward</label>
                <input type="number" name="xp_reward" id="xp_reward" 
                       class="w-full rounded-lg border-gray-300 focus:border-[#0F766E] focus:ring-[#0F766E]"
                       placeholder="100"
                       value="{{ old('xp_reward', 100) }}" 
                       min="1" required>
                <p class="mt-1 text-sm text-gray-500">Jumlah XP yang diperoleh pengguna saat mendapat badge ini</p>
                @error('xp_reward')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.badges.index') }}" 
                   class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-[#0F766E] text-white px-6 py-3 rounded-lg hover:bg-[#0F766E]/90 transition-colors">
                    Buat Badge
                </button>
            </div>
        </form>
    </div>
@endsection
