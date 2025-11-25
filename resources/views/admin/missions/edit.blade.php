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

    <div class="max-w-4xl mx-auto">
        <div class="flex items-center space-x-4 mb-8">
            <a href="{{ route('admin.missions.show', $mission) }}" class="text-gray-500 hover:text-gray-700">
                <x-heroicon-s-arrow-left class="h-6 w-6" />
            </a>
            <div>
                <h1 class="text-3xl font-bold text-[#0F766E] opacity-60">Edit Misi (Old System)</h1>
                <p class="text-gray-600">Edit misi: <span class="font-semibold">{{ $mission->title }}</span> (Sistem Lama - Deprecated)</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('admin.missions.update', $mission) }}" method="POST" id="missionForm">
                @csrf
                @method('PUT')

                <!-- Basic Mission Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Misi *
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title', $mission->title) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('title') border-red-500 @enderror"
                            required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi Misi *
                        </label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('description') border-red-500 @enderror"
                            required>{{ old('description', $mission->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tipe Misi *
                        </label>
                        <select id="type" name="type"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('type') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Tipe Misi</option>
                            <option value="reading" {{ old('type', $mission->type) === 'reading' ? 'selected' : '' }}>
                                Reading (Membaca Artikel)</option>
                            <option value="quiz" {{ old('type', $mission->type) === 'quiz' ? 'selected' : '' }}>Quiz
                            </option>
                            <option value="mixed" {{ old('type', $mission->type) === 'mixed' ? 'selected' : '' }}>Mixed
                                (Membaca + Quiz)</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="xp_reward" class="block text-sm font-semibold text-gray-700 mb-2">
                            XP Reward *
                        </label>
                        <input type="number" id="xp_reward" name="xp_reward"
                            value="{{ old('xp_reward', $mission->xp_reward) }}" min="0"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('xp_reward') border-red-500 @enderror"
                            required>
                        @error('xp_reward')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status *
                        </label>
                        <select id="status" name="status"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('status') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Status</option>
                            <option value="draft" {{ old('status', $mission->status) === 'draft' ? 'selected' : '' }}>
                                Draft</option>
                            <option value="active" {{ old('status', $mission->status) === 'active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="inactive"
                                {{ old('status', $mission->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="expired" {{ old('status', $mission->status) === 'expired' ? 'selected' : '' }}>
                                Expired</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <hr class="my-8">

                <!-- Articles Section -->
                <div id="articlesSection" class="mb-10">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">Artikel dalam Misi</h3>
                            <p class="text-sm text-gray-500">Pilih artikel yang akan dimasukkan dalam misi ini</p>
                        </div>
                        <button type="button" id="addArticleBtn"
                            class="bg-[#0F766E] text-white px-5 py-2 rounded-lg shadow hover:bg-[#0d6f64] transition-all flex items-center gap-2">
                            <x-heroicon-s-plus class="h-5 w-5" />
                            Tambah Artikel
                        </button>
                    </div>

                    <div id="articlesList" class="space-y-4">
                        <!-- Existing articles will be loaded here -->
                    </div>
                </div>

                <!-- Quiz Section -->
                <div id="quizSection" class="mb-10" style="display:none;">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Quiz dalam Misi</h3>
                    <div class="mb-4">
                        <label for="quiz_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Quiz *</label>
                        <select name="quiz_id" id="quiz_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]">
                            <option value="">Pilih Quiz</option>
                            @if (isset($quizzes))
                                @foreach ($quizzes as $quiz)
                                    <option value="{{ $quiz->id }}"
                                        {{ old('quiz_id', $mission->quiz_id ?? '') == $quiz->id ? 'selected' : '' }}>
                                        {{ $quiz->title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="passing_score" class="block text-sm font-semibold text-gray-700 mb-2">Passing Score
                            *</label>
                        <input type="number" name="passing_score" id="passing_score" min="0" max="100"
                            value="{{ old('passing_score', $mission->passing_score ?? '') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]">
                        <p class="text-xs text-gray-500 mt-1">Skor minimal agar user dinyatakan lulus quiz</p>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <a href="{{ route('admin.missions.show', $mission) }}"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-[#0F766E] text-white rounded-lg shadow hover:bg-[#0d6f64] transition-all">
                        Update Misi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Article Item Template -->
    <template id="articleItemTemplate">
        <div class="border border-gray-200 rounded-xl p-4 article-item bg-gray-50">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-semibold text-gray-900">Artikel</h4>
                <button type="button" class="text-red-600 hover:text-red-800 remove-article flex items-center gap-1">
                    <x-heroicon-s-trash class="h-5 w-5" />
                    <span class="text-xs">Hapus</span>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Pilih Artikel *
                    </label>
                    <select name="articles[][id]"
                        class="article-select w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                        required>
                        <option value="">Pilih Artikel</option>
                        <!-- Options will be added by JavaScript -->
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Waktu Baca Minimal (menit) *
                    </label>
                    <input type="number" name="articles[][min_read_time]" min="1" placeholder="e.g., 5"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                        required>
                    <p class="text-xs text-gray-500 mt-1">Berapa menit minimal user membaca artikel</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Urutan *
                    </label>
                    <input type="number" name="articles[][order_index]" min="1" placeholder="1"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                        required>
                    <p class="text-xs text-gray-500 mt-1">Urutan artikel dalam misi</p>
                </div>
            </div>
        </div>
    </template>

    <script>
        let articleIndex = 0;
        const existingArticles = @json($missionArticles);
        const articles = @json($articles);

        function populateArticleSelect(selectElement, selectedId = null) {
            selectElement.innerHTML = '<option value="">Pilih Artikel</option>';
            articles.forEach(article => {
                const option = document.createElement('option');
                option.value = article.id;
                option.textContent = article.title;
                if (selectedId && article.id == selectedId) {
                    option.selected = true;
                }
                selectElement.appendChild(option);
            });
        }

        function addArticle(articleData = null) {
            const template = document.getElementById('articleItemTemplate');
            const clone = template.content.cloneNode(true);
            const selects = clone.querySelectorAll('select, input');
            selects.forEach(element => {
                if (element.name) {
                    element.name = element.name.replace('[]', `[${articleIndex}]`);
                }
            });
            const articleSelect = clone.querySelector('.article-select');
            const selectedArticleId = articleData ? articleData.article_id : null;
            populateArticleSelect(articleSelect, selectedArticleId);
            if (articleData) {
                const minReadTimeInput = clone.querySelector('input[name*="min_read_time"]');
                const orderIndexInput = clone.querySelector('input[name*="order_index"]');
                minReadTimeInput.value = articleData.min_read_time;
                orderIndexInput.value = articleData.order_index;
            }
            clone.querySelector('.remove-article').addEventListener('click', function() {
                this.closest('.article-item').remove();
                updateOrderIndexes();
            });
            document.getElementById('articlesList').appendChild(clone);
            articleIndex++;
        }

        document.getElementById('addArticleBtn').addEventListener('click', function() {
            addArticle();
            updateOrderIndexes();
        });

        function updateOrderIndexes() {
            const orderInputs = document.querySelectorAll('input[name*="order_index"]');
            orderInputs.forEach((input, index) => {
                if (!input.value || input.value === '') {
                    input.value = index + 1;
                }
            });
        }

        existingArticles.forEach(articleData => {
            addArticle(articleData);
        });
        if (existingArticles.length === 0) {
            addArticle();
        }

        function updateSectionVisibility() {
            const type = document.getElementById('type').value;
            document.getElementById('articlesSection').style.display = (type === 'reading' || type === 'mixed') ? '' :
                'none';
            document.getElementById('quizSection').style.display = (type === 'quiz' || type === 'mixed') ? '' : 'none';
        }
        document.getElementById('type').addEventListener('change', updateSectionVisibility);
        updateSectionVisibility();
    </script>
@endsection
