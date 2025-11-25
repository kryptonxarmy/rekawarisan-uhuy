@extends('admin.AdminLayout')

@section('content')
    {{-- WARNING: OLD MISSION SYSTEM - DEPRECATED --}}
    {{-- 
        This is the OLD mission system that is being phased out.
        New missions should use the Daily Mission system instead.
        This page is kept for backward compatibility only.
    --}}
    
    <!-- Deprecated Notice -->
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
        <div class="flex items-center">
            <x-heroicon-s-exclamation-triangle class="h-6 w-6 text-red-600 mr-3" />
            <div>
                <h3 class="text-red-800 font-semibold">Sistem Misi Lama (Deprecated)</h3>
                <p class="text-red-700 text-sm">Halaman ini menggunakan sistem misi lama. Gunakan halaman "Misi Harian" untuk misi baru.</p>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.missions.index') }}" class="text-gray-500 hover:text-gray-700">
                <x-heroicon-s-arrow-left class="h-6 w-6" />
            </a>
            <div>
                <h1 class="text-2xl font-bold text-[#0F766E] opacity-60">Buat Misi Baru (Old System)</h1>
                <p class="text-gray-600">Buat misi baru untuk pengguna Jejak Maestro (Sistem Lama - Deprecated).</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.missions.store') }}" method="POST" id="missionForm">
            @csrf

            <!-- Basic Mission Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Misi *
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('title') border-red-500 @enderror"
                        required>
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Misi *
                    </label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('description') border-red-500 @enderror"
                        required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Misi *
                    </label>
                    <select id="type" name="type"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('type') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Tipe Misi</option>
                        <option value="read" {{ old('type') === 'read' ? 'selected' : '' }}>Reading (Membaca Artikel)</option>
                        <option value="quiz" {{ old('type') === 'quiz' ? 'selected' : '' }}>Quiz</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="xp_reward" class="block text-sm font-medium text-gray-700 mb-2">
                        XP Reward *
                    </label>
                    <input type="number" id="xp_reward" name="xp_reward" value="{{ old('xp_reward') }}" min="0"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('xp_reward') border-red-500 @enderror"
                        required>
                    @error('xp_reward')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status *
                    </label>
                    <select id="status" name="status"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('status') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Status</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="expired" {{ old('status') === 'expired' ? 'selected' : '' }}>Expired</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Articles Section -->
            <div class="border-t pt-8" id="articlesSection">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Artikel dalam Misi</h3>
                        <p class="text-sm text-gray-500">Pilih artikel yang akan dimasukkan dalam misi ini</p>
                    </div>
                    <button type="button" id="addArticleBtn"
                        class="bg-[#0F766E] text-white px-4 py-2 rounded-md hover:bg-[#0d6f64] transition-colors">
                        <x-heroicon-s-plus class="h-4 w-4 inline mr-1" />
                        Tambah Artikel
                    </button>
                </div>

                <div id="articlesList" class="space-y-4">
                    <!-- Articles will be added dynamically -->
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                <a href="{{ route('admin.missions.index') }}"
                    class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-[#0F766E] text-white rounded-md hover:bg-[#0d6f64]">
                    Simpan Misi
                </button>
            </div>
        </form>
    </div>

    <!-- Article Item Template -->
    <template id="articleItemTemplate">
        <div class="border border-gray-200 rounded-lg p-4 article-item">
            <div class="flex justify-between items-start mb-4">
                <h4 class="font-medium text-gray-900">Artikel</h4>
                <button type="button" class="text-red-600 hover:text-red-800 remove-article">
                    <x-heroicon-s-trash class="h-4 w-4" />
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Artikel *
                    </label>
                    <select name="articles[][id]"
                        class="article-select w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                        required>
                        <option value="">Pilih Artikel</option>
                        <!-- Options will be added by JavaScript -->
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Waktu Baca Minimal (menit) *
                    </label>
                    <input type="number" name="articles[][min_read_time]" min="1" placeholder="e.g., 5"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                        required>
                    <p class="text-xs text-gray-500 mt-1">Berapa menit minimal user membaca artikel</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Urutan *
                    </label>
                    <input type="number" name="articles[][order_index]" min="1" placeholder="1"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                        required>
                    <p class="text-xs text-gray-500 mt-1">Urutan artikel dalam misi</p>
                </div>
            </div>
        </div>
    </template>

    <script>
        let articleIndex = 0;

        // Articles data from Laravel
        const articles = @json($articles);

        function populateArticleSelect(selectElement) {
            // Clear existing options except the first one
            selectElement.innerHTML = '<option value="">Pilih Artikel</option>';

            // Add articles to select
            articles.forEach(article => {
                const option = document.createElement('option');
                option.value = article.id;
                option.textContent = article.title;
                selectElement.appendChild(option);
            });
        }

        document.getElementById('addArticleBtn').addEventListener('click', function() {
            const template = document.getElementById('articleItemTemplate');
            const clone = template.content.cloneNode(true);

            // Update name attributes with index
            const selects = clone.querySelectorAll('select, input');
            selects.forEach(element => {
                if (element.name) {
                    element.name = element.name.replace('[]', `[${articleIndex}]`);
                }
            });

            // Populate article select dropdown
            const articleSelect = clone.querySelector('.article-select');
            populateArticleSelect(articleSelect);

            // Add remove functionality
            clone.querySelector('.remove-article').addEventListener('click', function() {
                this.closest('.article-item').remove();
                updateOrderIndexes();
            });

            document.getElementById('articlesList').appendChild(clone);
            articleIndex++;
            updateOrderIndexes();
        });

        function updateOrderIndexes() {
            const orderInputs = document.querySelectorAll('input[name*="order_index"]');
            orderInputs.forEach((input, index) => {
                input.value = index + 1;
            });
        }

        // Add first article by default
        document.getElementById('addArticleBtn').click();
    </script>
@endsection
