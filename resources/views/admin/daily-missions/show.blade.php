@extends('admin.AdminLayout')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.daily-missions.index') }}" class="text-gray-500 hover:text-gray-700">
                    <x-heroicon-s-arrow-left class="h-6 w-6" />
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-[#0F766E]">Detail Misi Harian</h1>
                    <p class="text-gray-600">{{ $dailyMission->date->format('d F Y') }} - {{ $dailyMission->date->format('l') }}</p>
                </div>
            </div>
            
            <div class="flex space-x-3">
                @if ($dailyMission->date->isFuture())
                    <a href="{{ route('admin.daily-missions.edit', $dailyMission) }}"
                        class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors">
                        <x-heroicon-s-pencil class="h-5 w-5 inline mr-1" />
                        Edit
                    </a>
                @endif
                
                @if ($dailyMission->date->isToday())
                    <span class="bg-green-100 text-green-800 px-3 py-2 rounded-lg font-medium">
                        ✨ Aktif Hari Ini
                    </span>
                @elseif ($dailyMission->date->isFuture())
                    <span class="bg-blue-100 text-blue-800 px-3 py-2 rounded-lg font-medium">
                        📅 Dijadwalkan
                    </span>
                @else
                    <span class="bg-gray-100 text-gray-800 px-3 py-2 rounded-lg font-medium">
                        ✅ Selesai
                    </span>
                @endif
            </div>
        </div>

        <!-- Mission Info -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $dailyMission->title }}</h2>
                <p class="text-gray-600">{{ $dailyMission->description }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">📊 Statistik</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Tasks:</span>
                            <span class="font-medium">{{ $dailyMission->tasks->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total XP:</span>
                            <span class="font-medium">{{ $dailyMission->tasks->sum('xp_reward') }} XP</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">User Progress:</span>
                            <span class="font-medium">{{ $dailyMission->tasks->flatMap->userProgress->unique('user_id')->count() }} Users</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">🎯 Completion Rate</h3>
                    @php
                        $totalProgress = $dailyMission->tasks->flatMap->userProgress->count();
                        $completedProgress = $dailyMission->tasks->flatMap->userProgress->where('status', 'completed')->count();
                        $completionRate = $totalProgress > 0 ? ($completedProgress / $totalProgress) * 100 : 0;
                    @endphp
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Completed:</span>
                            <span class="font-medium text-green-600">{{ $completedProgress }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Pending:</span>
                            <span class="font-medium text-yellow-600">{{ $dailyMission->tasks->flatMap->userProgress->where('status', 'pending')->count() }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $completionRate }}%"></div>
                        </div>
                        <p class="text-sm text-gray-500">{{ number_format($completionRate, 1) }}% completion rate</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">📅 Timeline</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal:</span>
                            <span class="font-medium">{{ $dailyMission->date->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Hari:</span>
                            <span class="font-medium">{{ $dailyMission->date->format('l') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            @if ($dailyMission->date->isToday())
                                <span class="font-medium text-green-600">Aktif</span>
                            @elseif ($dailyMission->date->isFuture())
                                <span class="font-medium text-blue-600">Dijadwalkan</span>
                            @else
                                <span class="font-medium text-gray-600">Selesai</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks Details -->
        <div class="space-y-6">
            @foreach ($dailyMission->tasks as $index => $task)
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-6">
                        @if ($task->type === 'read')
                            <div class="bg-blue-100 text-blue-600 rounded-full w-10 h-10 flex items-center justify-center text-lg font-bold mr-4">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">📖 Task {{ $index + 1 }}: Baca Artikel</h3>
                                <p class="text-gray-600">User harus membaca artikel dengan waktu minimal {{ $task->timer_seconds }} detik</p>
                            </div>
                        @elseif ($task->type === 'engage')
                            <div class="bg-purple-100 text-purple-600 rounded-full w-10 h-10 flex items-center justify-center text-lg font-bold mr-4">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">💬 Task {{ $index + 1 }}: Like & Komen</h3>
                                <p class="text-gray-600">User harus like dan komen artikel ({{ $task->required_count }} aksi)</p>
                            </div>
                        @elseif ($task->type === 'quiz')
                            <div class="bg-yellow-100 text-yellow-600 rounded-full w-10 h-10 flex items-center justify-center text-lg font-bold mr-4">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">🧠 Task {{ $index + 1 }}: Quiz</h3>
                                <p class="text-gray-600">Quiz berdasarkan artikel dengan {{ $task->quizzes->count() }} soal</p>
                            </div>
                        @endif

                        <div class="ml-auto">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $task->xp_reward }} XP
                            </span>
                        </div>
                    </div>

                    @if ($task->type === 'read' || $task->type === 'engage')
                        <!-- Article Details -->
                        @if ($task->articles->isNotEmpty())
                            @php $article = $task->articles->first()->article; @endphp
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-900 mb-2">📄 Artikel</h4>
                                <div class="flex items-start space-x-4">
                                    @if ($article->featured_image)
                                        <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                             alt="{{ $article->title }}"
                                             class="w-16 h-16 rounded-lg object-cover">
                                    @endif
                                    <div class="flex-1">
                                        <h5 class="font-medium text-gray-900">{{ $article->title }}</h5>
                                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($article->content, 100) }}</p>
                                        <div class="flex items-center space-x-4 mt-2">
                                            <span class="text-xs text-gray-500">Kategori: {{ $article->category->name }}</span>
                                            <span class="text-xs text-gray-500">Status: {{ ucfirst($article->status) }}</span>
                                            @if ($task->type === 'read')
                                                <span class="text-xs text-gray-500">Min. baca: {{ $task->timer_seconds }}s</span>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.articles.show', $article) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm">
                                        Lihat Detail →
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif

                    @if ($task->type === 'quiz')
                        <!-- Quiz Questions -->
                        <div class="space-y-4">
                            @foreach ($task->quizzes as $quizIndex => $quiz)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-900 mb-3">Soal {{ $quizIndex + 1 }}: {{ $quiz->question }}</h4>
                                    
                                    <div class="space-y-2">
                                        @foreach ($quiz->options as $optionIndex => $option)
                                            <div class="flex items-center space-x-3">
                                                @if ($option->is_correct)
                                                    <span class="w-6 h-6 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-sm font-bold">
                                                        ✓
                                                    </span>
                                                @else
                                                    <span class="w-6 h-6 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center text-sm">
                                                        {{ chr(65 + $optionIndex) }}
                                                    </span>
                                                @endif
                                                <span class="text-gray-700 {{ $option->is_correct ? 'font-medium text-green-700' : '' }}">
                                                    {{ $option->option_text }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($quiz->explanation)
                                        <div class="mt-3 p-3 bg-blue-50 rounded">
                                            <p class="text-sm text-blue-800"><strong>Penjelasan:</strong> {{ $quiz->explanation }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- User Progress for this task -->
                    @if ($task->userProgress->isNotEmpty())
                        <div class="mt-6 border-t pt-4">
                            <h4 class="font-semibold text-gray-900 mb-3">Progress User ({{ $task->userProgress->count() }} users)</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-center p-3 bg-green-50 rounded-lg">
                                    <div class="text-2xl font-bold text-green-600">{{ $task->userProgress->where('status', 'completed')->count() }}</div>
                                    <div class="text-sm text-green-600">Completed</div>
                                </div>
                                <div class="text-center p-3 bg-yellow-50 rounded-lg">
                                    <div class="text-2xl font-bold text-yellow-600">{{ $task->userProgress->where('status', 'pending')->count() }}</div>
                                    <div class="text-sm text-yellow-600">Pending</div>
                                </div>
                                <div class="text-center p-3 bg-red-50 rounded-lg">
                                    <div class="text-2xl font-bold text-red-600">{{ $task->userProgress->where('status', 'failed')->count() }}</div>
                                    <div class="text-sm text-red-600">Failed</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
