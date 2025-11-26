@extends('admin.AdminLayout')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center space-x-4 mb-8">
            <a href="{{ route('admin.daily-missions.index') }}" class="text-gray-500 hover:text-gray-700">
                <x-heroicon-s-arrow-left class="h-6 w-6" />
            </a>
            <div>
                <h1 class="text-3xl font-bold text-[#0F766E]">Buat Misi Harian Baru</h1>
                <p class="text-gray-600">Atur misi harian dengan 3 task: baca artikel, like & komen, dan quiz.</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('admin.daily-missions.store') }}" method="POST" id="dailyMissionForm">
                @csrf

                <!-- Basic Daily Mission Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div>
                        <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Misi *
                        </label>
                        <input type="date" id="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('date') border-red-500 @enderror"
                            required min="{{ now()->format('Y-m-d') }}">
                        @error('date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Misi *
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            placeholder="Contoh: Jelajahi Budaya Nusantara"
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
                        <textarea id="description" name="description" rows="3"
                            placeholder="Deskripsi singkat tentang misi harian ini..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('description') border-red-500 @enderror"
                            required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <hr class="my-8">

                <!-- Task 1: Read Article -->
                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="bg-blue-100 text-blue-600 rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-3">1</div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">Task 1: Baca Artikel</h3>
                            <p class="text-sm text-gray-500">User harus membaca artikel dengan waktu minimal tertentu</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-blue-50 p-6 rounded-lg">
                        <div>
                            <label for="read_article_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Pilih Artikel *
                            </label>
                            <select id="read_article_id" name="read_article_id"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('read_article_id') border-red-500 @enderror"
                                required>
                                <option value="">Pilih artikel...</option>
                                @foreach ($articles as $article)
                                    <option value="{{ $article->id }}" {{ old('read_article_id') == $article->id ? 'selected' : '' }}>
                                        {{ $article->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('read_article_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="read_timer_seconds" class="block text-sm font-semibold text-gray-700 mb-2">
                                Waktu Baca Minimal (detik) *
                            </label>
                            <input type="number" id="read_timer_seconds" name="read_timer_seconds"
                                value="{{ old('read_timer_seconds', 120) }}" min="30" max="3600"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('read_timer_seconds') border-red-500 @enderror"
                                required>
                            <p class="text-xs text-gray-500 mt-1">Minimal 30 detik, maksimal 1 jam</p>
                            @error('read_timer_seconds')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="read_xp_reward" class="block text-sm font-semibold text-gray-700 mb-2">
                                XP Reward *
                            </label>
                            <input type="number" id="read_xp_reward" name="read_xp_reward"
                                value="{{ old('read_xp_reward', 50) }}" min="1"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('read_xp_reward') border-red-500 @enderror"
                                required>
                            @error('read_xp_reward')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Task 2: Engage (Like & Comment) -->
                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="bg-purple-100 text-purple-600 rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-3">2</div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">Task 2: Like & Komen</h3>
                            <p class="text-sm text-gray-500">User harus like dan memberi komen pada artikel yang sama</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-purple-50 p-6 rounded-lg">
                        <div>
                            <label for="engage_required_count" class="block text-sm font-semibold text-gray-700 mb-2">
                                Jumlah Aksi yang Dibutuhkan *
                            </label>
                            <select id="engage_required_count" name="engage_required_count"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('engage_required_count') border-red-500 @enderror"
                                required>
                                <option value="2" {{ old('engage_required_count', 2) == 2 ? 'selected' : '' }}>2 Aksi (Like + Komen)</option>
                                <option value="1" {{ old('engage_required_count') == 1 ? 'selected' : '' }}>1 Aksi (Hanya Like atau Komen)</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Biasanya 2 aksi: like dan komen</p>
                            @error('engage_required_count')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="engage_xp_reward" class="block text-sm font-semibold text-gray-700 mb-2">
                                XP Reward *
                            </label>
                            <input type="number" id="engage_xp_reward" name="engage_xp_reward"
                                value="{{ old('engage_xp_reward', 30) }}" min="1"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('engage_xp_reward') border-red-500 @enderror"
                                required>
                            @error('engage_xp_reward')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex">
                            <x-heroicon-s-information-circle class="h-5 w-5 text-yellow-600 mr-2" />
                            <p class="text-sm text-yellow-800">
                                Task ini menggunakan artikel yang sama dengan Task 1. User harus like dan komen artikel tersebut.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Task 3: Quiz (Will be handled in next step) -->
                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="bg-yellow-100 text-yellow-600 rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-3">3</div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">Task 3: Quiz</h3>
                            <p class="text-sm text-gray-500">Quiz berdasarkan materi artikel (akan dibuat di langkah selanjutnya)</p>
                        </div>
                    </div>

                    <div class="bg-yellow-50 p-6 rounded-lg">
                        <div>
                            <label for="quiz_xp_reward" class="block text-sm font-semibold text-gray-700 mb-2">
                                XP Reward untuk Quiz *
                            </label>
                            <input type="number" id="quiz_xp_reward" name="quiz_xp_reward"
                                value="{{ old('quiz_xp_reward', 70) }}" min="1"
                                class="w-full md:w-1/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('quiz_xp_reward') border-red-500 @enderror"
                                required>
                            @error('quiz_xp_reward')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Placeholder for quiz questions -->
                        <div id="quizSection" class="mt-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Soal Quiz</h4>
                            <p class="text-sm text-gray-500 mb-4">Tambahkan soal quiz berdasarkan artikel yang dipilih di atas.</p>
                            
                            <div id="quizQuestions" class="space-y-6">
                                <!-- Quiz questions will be added here -->
                            </div>

                            <button type="button" id="addQuestionBtn"
                                class="mt-4 bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-all flex items-center gap-2">
                                <x-heroicon-s-plus class="h-5 w-5" />
                                Tambah Soal
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <a href="{{ route('admin.daily-missions.index') }}"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-[#0F766E] text-white rounded-lg shadow hover:bg-[#0d6f64] transition-all">
                        Simpan Misi Harian
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Quiz Question Template -->
    <template id="quizQuestionTemplate">
        <div class="quiz-question border border-gray-200 rounded-lg p-4 bg-white">
            <div class="flex justify-between items-center mb-4">
                <h5 class="font-medium text-gray-900">Soal <span class="question-number">1</span></h5>
                <button type="button" class="text-red-600 hover:text-red-800 remove-question">
                    <x-heroicon-s-trash class="h-5 w-5" />
                </button>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pertanyaan *</label>
                <textarea name="quiz_questions[][question]" rows="2" placeholder="Masukkan pertanyaan..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                    required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Penjelasan (Opsional)</label>
                <textarea name="quiz_questions[][explanation]" rows="2" placeholder="Penjelasan jawaban..."
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"></textarea>
            </div>

            <div class="quiz-options space-y-3">
                <p class="text-sm font-medium text-gray-700 mb-2">Pilihan Jawaban *</p>
                <!-- Options will be added here -->
            </div>

            <button type="button" class="add-option mt-3 text-sm text-blue-600 hover:text-blue-800">
                + Tambah Pilihan
            </button>
        </div>
    </template>

    <!-- Quiz Option Template -->
    <template id="quizOptionTemplate">
        <div class="quiz-option flex items-center space-x-3">
            <input type="radio" name="quiz_questions[][correct_option]" value="" class="correct-radio">
            <input type="text" name="quiz_questions[][options][][text]" placeholder="Masukkan pilihan jawaban..."
                class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]" required>
            <button type="button" class="text-red-600 hover:text-red-800 remove-option">
                <x-heroicon-s-x-mark class="h-4 w-4" />
            </button>
        </div>
    </template>

<script>
    let questionIndex = 0;

    document.getElementById('addQuestionBtn').addEventListener('click', function() {
        addQuestion();
    });

    function addQuestion() {
        const template = document.getElementById('quizQuestionTemplate');
        const clone = template.content.cloneNode(true);

        // Nomor soal
        clone.querySelector('.question-number').textContent = questionIndex + 1;

        // Update name index
        const inputs = clone.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            if (input.name) {
                input.name = input.name.replace('[]', `[${questionIndex}]`);
            }
        });

        // Tombol hapus soal
        clone.querySelector('.remove-question').addEventListener('click', function() {
            this.closest('.quiz-question').remove();
            updateQuestionNumbers();
        });

        // Tombol tambah opsi
        clone.querySelector('.add-option').addEventListener('click', function() {
            addOption(this.closest('.quiz-question'), questionIndex);
        });

        document.getElementById('quizQuestions').appendChild(clone);

        // Tambahkan 4 opsi default
        const questionElement = document.querySelectorAll('.quiz-question')[questionIndex];
        for (let i = 0; i < 4; i++) {
            addOption(questionElement, questionIndex);
        }

        questionIndex++;
    }

    function addOption(questionElement, qIndex) {
        const template = document.getElementById('quizOptionTemplate');
        const clone = template.content.cloneNode(true);

        const optionsContainer = questionElement.querySelector('.quiz-options');
        const optionIndex = optionsContainer.querySelectorAll('.quiz-option').length;

        // Update form names
        const textInput = clone.querySelector('input[type="text"]');
        const radio = clone.querySelector('input[type="radio"]');

        textInput.name = `quiz_questions[${qIndex}][options][${optionIndex}][text]`;
        radio.name = `quiz_questions[${qIndex}][correct_option]`;
        radio.value = optionIndex;

        // Hidden correct
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = `quiz_questions[${qIndex}][options][${optionIndex}][is_correct]`;
        hiddenInput.value = '0';
        clone.appendChild(hiddenInput);

        // Update ketika memilih jawaban benar
        radio.addEventListener('change', function() {
            questionElement.querySelectorAll('input[name*="[is_correct]"]').forEach(input => {
                input.value = '0';
            });
            hiddenInput.value = this.checked ? '1' : '0';
        });

        // Hapus opsi
        clone.querySelector('.remove-option').addEventListener('click', function() {
            this.closest('.quiz-option').remove();
            updateOptionIndexes(questionElement, qIndex);
        });

        optionsContainer.appendChild(clone);
    }

    function updateOptionIndexes(questionElement, qIndex) {
        const options = questionElement.querySelectorAll('.quiz-option');

        options.forEach((option, newIndex) => {
            const textInput = option.querySelector('input[type="text"]');
            const radio = option.querySelector('input[type="radio"]');
            const hiddenInput = option.querySelector('input[type="hidden"]');

            // Update name sesuai index baru
            textInput.name = `quiz_questions[${qIndex}][options][${newIndex}][text]`;
            radio.name = `quiz_questions[${qIndex}][correct_option]`;
            radio.value = newIndex;
            hiddenInput.name = `quiz_questions[${qIndex}][options][${newIndex}][is_correct]`;
        });
    }

    function updateQuestionNumbers() {
        const questions = document.querySelectorAll('.quiz-question');
        questions.forEach((q, index) => {
            q.querySelector('.question-number').textContent = index + 1;
        });
        questionIndex = questions.length;
    }
</script>

@endsection
