@extends('admin.AdminLayout')

@section('content')
    {{-- Helper PHP untuk mengambil data Task spesifik agar kode HTML lebih bersih --}}
    @php
        $readTask = $dailyMission->tasks->where('type', 'read')->first();
        $engageTask = $dailyMission->tasks->where('type', 'engage')->first();
        $quizTask = $dailyMission->tasks->where('type', 'quiz')->first();
        // Ambil questions jika ada, decode dari JSON column (asumsi struktur penyimpanan JSON)
        // Atau jika menggunakan relation hasMany questions, sesuaikan ($quizTask->questions)
        // Di sini saya asumsikan relation atau properti aksesibel
        $existingQuestions = $quizTask ? $quizTask->questions : collect([]); 
    @endphp

    <div class="max-w-4xl mx-auto">
        <div class="flex items-center space-x-4 mb-8">
            <a href="{{ route('admin.daily-missions.index') }}" class="text-gray-500 hover:text-gray-700">
                <x-heroicon-s-arrow-left class="h-6 w-6" />
            </a>
            <div>
                <h1 class="text-3xl font-bold text-[#0F766E]">Edit Misi Harian</h1>
                <p class="text-gray-600">
                    Edit detail misi, task, dan kuis untuk tanggal: 
                    <span class="font-semibold">{{ $dailyMission->date?->format('d F Y') }}</span>
                </p>
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
            <form action="{{ route('admin.daily-missions.update', $dailyMission) }}" method="POST" id="dailyMissionForm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div>
                        <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Misi *
                        </label>
                        <input type="date" id="date" name="date" 
                            value="{{ old('date', $dailyMission->date?->format('Y-m-d')) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E] @error('date') border-red-500 @enderror"
                            required>
                        @error('date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Misi *
                        </label>
                        <input type="text" id="title" name="title" 
                            value="{{ old('title', $dailyMission->title) }}"
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
                            required>{{ old('description', $dailyMission->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <hr class="my-8">

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
                                    <option value="{{ $article->id }}" 
                                        {{ old('read_article_id', $readTask?->article_id) == $article->id ? 'selected' : '' }}>
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
                                Waktu Baca (detik) *
                            </label>
                            <input type="number" id="read_timer_seconds" name="read_timer_seconds"
                                value="{{ old('read_timer_seconds', $readTask?->timer_seconds ?? 120) }}" min="30" max="3600"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                                required>
                            @error('read_timer_seconds')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="read_xp_reward" class="block text-sm font-semibold text-gray-700 mb-2">
                                XP Reward *
                            </label>
                            <input type="number" id="read_xp_reward" name="read_xp_reward"
                                value="{{ old('read_xp_reward', $readTask?->xp_reward ?? 50) }}" min="1"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                                required>
                            @error('read_xp_reward')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="bg-purple-100 text-purple-600 rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-3">2</div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">Task 2: Like & Komen</h3>
                            <p class="text-sm text-gray-500">Aksi interaksi pada artikel yang sama</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-purple-50 p-6 rounded-lg">
                        <div>
                            <label for="engage_required_count" class="block text-sm font-semibold text-gray-700 mb-2">
                                Jumlah Aksi *
                            </label>
                            <select id="engage_required_count" name="engage_required_count"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                                required>
                                <option value="2" {{ old('engage_required_count', $engageTask?->required_count) == 2 ? 'selected' : '' }}>2 Aksi (Like + Komen)</option>
                                <option value="1" {{ old('engage_required_count', $engageTask?->required_count) == 1 ? 'selected' : '' }}>1 Aksi (Hanya Like/Komen)</option>
                            </select>
                            @error('engage_required_count')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="engage_xp_reward" class="block text-sm font-semibold text-gray-700 mb-2">
                                XP Reward *
                            </label>
                            <input type="number" id="engage_xp_reward" name="engage_xp_reward"
                                value="{{ old('engage_xp_reward', $engageTask?->xp_reward ?? 30) }}" min="1"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                                required>
                            @error('engage_xp_reward')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="bg-yellow-100 text-yellow-600 rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-3">3</div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">Task 3: Quiz</h3>
                            <p class="text-sm text-gray-500">Soal quiz berdasarkan artikel</p>
                        </div>
                    </div>

                    <div class="bg-yellow-50 p-6 rounded-lg">
                        <div>
                            <label for="quiz_xp_reward" class="block text-sm font-semibold text-gray-700 mb-2">
                                XP Reward Quiz *
                            </label>
                            <input type="number" id="quiz_xp_reward" name="quiz_xp_reward"
                                value="{{ old('quiz_xp_reward', $quizTask?->xp_reward ?? 70) }}" min="1"
                                class="w-full md:w-1/3 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                                required>
                        </div>

                        <div id="quizSection" class="mt-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Daftar Soal</h4>
                            
                            <div id="quizQuestions" class="space-y-6">
                                {{-- Render Existing Questions from Database --}}
                                @if(old('quiz_questions'))
                                    {{-- Jika ada error validasi dan kembali ke form, gunakan data OLD --}}
                                    {{-- Implementasi untuk OLD data cukup kompleks, biasanya diloop ulang --}}
                                @elseif($existingQuestions)
                                    @foreach($existingQuestions as $index => $question)
                                        <div class="quiz-question border border-gray-200 rounded-lg p-4 bg-white" data-index="{{ $index }}">
                                            <div class="flex justify-between items-center mb-4">
                                                <h5 class="font-medium text-gray-900">Soal <span class="question-number">{{ $index + 1 }}</span></h5>
                                                <button type="button" class="text-red-600 hover:text-red-800 remove-question">
                                                    <x-heroicon-s-trash class="h-5 w-5" />
                                                </button>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Pertanyaan *</label>
                                                <textarea name="quiz_questions[{{ $index }}][question]" rows="2" 
                                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"
                                                    required>{{ $question['question'] ?? $question->question }}</textarea>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Penjelasan (Opsional)</label>
                                                <textarea name="quiz_questions[{{ $index }}][explanation]" rows="2"
                                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]">{{ $question['explanation'] ?? $question->explanation ?? '' }}</textarea>
                                            </div>

                                            <div class="quiz-options space-y-3">
                                                <p class="text-sm font-medium text-gray-700 mb-2">Pilihan Jawaban *</p>
                                                @php
                                                    $options = $question['options'] ?? $question->options;
                                                    // Handle structure variation (array or object)
                                                @endphp
                                                @foreach($options as $optIndex => $option)
                                                    <div class="quiz-option flex items-center space-x-3">
                                                        <input type="radio" name="quiz_questions[{{ $index }}][correct_option]" value="{{ $optIndex }}" 
                                                            class="correct-radio" 
                                                            {{ (isset($question['correct_option']) && $question['correct_option'] == $optIndex) ? 'checked' : '' }}>
                                                        
                                                        <input type="text" name="quiz_questions[{{ $index }}][options][{{ $optIndex }}][text]" 
                                                            value="{{ $option['text'] ?? $option }}" 
                                                            placeholder="Masukkan pilihan jawaban..."
                                                            class="flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]" required>
                                                        
                                                        <button type="button" class="text-red-600 hover:text-red-800 remove-option">
                                                            <x-heroicon-s-x-mark class="h-4 w-4" />
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <button type="button" class="add-option mt-3 text-sm text-blue-600 hover:text-blue-800">
                                                + Tambah Pilihan
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
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
                        Update Misi Harian
                    </button>
                </div>
            </form>
        </div>
    </div>

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
                <textarea rows="2" placeholder="Masukkan pertanyaan..." class="question-input w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Penjelasan (Opsional)</label>
                <textarea rows="2" placeholder="Penjelasan jawaban..." class="explanation-input w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]"></textarea>
            </div>
            <div class="quiz-options space-y-3">
                <p class="text-sm font-medium text-gray-700 mb-2">Pilihan Jawaban *</p>
                </div>
            <button type="button" class="add-option mt-3 text-sm text-blue-600 hover:text-blue-800">
                + Tambah Pilihan
            </button>
        </div>
    </template>

    <template id="quizOptionTemplate">
        <div class="quiz-option flex items-center space-x-3">
            <input type="radio" value="" class="correct-radio">
            <input type="text" placeholder="Masukkan pilihan jawaban..." class="option-input flex-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0F766E]" required>
            <button type="button" class="text-red-600 hover:text-red-800 remove-option">
                <x-heroicon-s-x-mark class="h-4 w-4" />
            </button>
        </div>
    </template>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questionsContainer = document.getElementById('quizQuestions');
            // Hitung jumlah soal yang sudah ada dari PHP render
            let questionIndex = questionsContainer.children.length;

            // --- Fungsi Helper untuk Re-Index (Agar radio button group unik per soal) ---
            function updateQuestionIndexes() {
                const questions = questionsContainer.querySelectorAll('.quiz-question');
                questions.forEach((q, qIdx) => {
                    // Update nomor visual
                    q.querySelector('.question-number').textContent = qIdx + 1;
                    
                    // Update name attribute untuk Question
                    const qInput = q.querySelector('textarea[name*="[question]"]') || q.querySelector('.question-input');
                    if(qInput) qInput.name = `quiz_questions[${qIdx}][question]`;

                    const eInput = q.querySelector('textarea[name*="[explanation]"]') || q.querySelector('.explanation-input');
                    if(eInput) eInput.name = `quiz_questions[${qIdx}][explanation]`;

                    // Update name attribute untuk Radio Button Group (PENTING)
                    const radios = q.querySelectorAll('.correct-radio');
                    radios.forEach(radio => {
                        radio.name = `quiz_questions[${qIdx}][correct_option]`;
                    });

                    // Update name attribute untuk Options Text
                    const options = q.querySelectorAll('.quiz-option');
                    options.forEach((opt, oIdx) => {
                        const oInput = opt.querySelector('input[type="text"]');
                        if(oInput) oInput.name = `quiz_questions[${qIdx}][options][${oIdx}][text]`;
                        
                        const oRadio = opt.querySelector('.correct-radio');
                        if(oRadio) oRadio.value = oIdx;
                    });
                });
                // Update global index
                questionIndex = questions.length;
            }

            // --- Event Delegation untuk Elemen Dinamis ---
            
            // 1. Hapus Soal
            questionsContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-question')) {
                    if (confirm('Hapus soal ini?')) {
                        e.target.closest('.quiz-question').remove();
                        updateQuestionIndexes();
                    }
                }
            });

            // 2. Tambah Opsi pada Soal Tertentu
            questionsContainer.addEventListener('click', function(e) {
                if (e.target.closest('.add-option')) {
                    const questionEl = e.target.closest('.quiz-question');
                    const optionsContainer = questionEl.querySelector('.quiz-options');
                    addOptionToContainer(optionsContainer, null); // null karena belum di-index ulang
                    updateQuestionIndexes(); // Re-index untuk memastikan name atribut benar
                }
            });

            // 3. Hapus Opsi
            questionsContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-option')) {
                    const optionsContainer = e.target.closest('.quiz-options');
                    // Cegah hapus jika sisa kurang dari 2 opsi (opsional logic)
                    e.target.closest('.quiz-option').remove();
                    updateQuestionIndexes();
                }
            });

            // --- Fungsi Tambah Soal Baru ---
            document.getElementById('addQuestionBtn').addEventListener('click', function() {
                const template = document.getElementById('quizQuestionTemplate');
                const clone = template.content.cloneNode(true);
                const questionEl = clone.querySelector('.quiz-question');
                const optionsContainer = questionEl.querySelector('.quiz-options');

                // Tambahkan 2 opsi default
                addOptionToContainer(optionsContainer);
                addOptionToContainer(optionsContainer);

                questionsContainer.appendChild(clone);
                updateQuestionIndexes();
            });

            // --- Fungsi Tambah Opsi Helper ---
            function addOptionToContainer(container) {
                const template = document.getElementById('quizOptionTemplate');
                const clone = template.content.cloneNode(true);
                container.appendChild(clone);
            }

            // Initial setup for existing buttons (jika ada tombol hapus yang dirender server-side)
            // Sebenarnya Event Delegation di atas sudah menangani ini, jadi tidak perlu loop listener manual.
        });
    </script>
@endsection