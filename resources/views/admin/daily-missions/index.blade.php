@extends('admin.AdminLayout')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#0F766E]">Kelola Misi Harian</h1>
            <p class="text-gray-600">Atur misi harian yang terdiri dari 3 task: baca artikel, like & komen, dan quiz.</p>
        </div>
        <a href="{{ route('admin.daily-missions.create') }}"
            class="bg-[#0F766E] text-white px-4 py-2 rounded-md hover:bg-[#0d6f64] transition-colors">
            <x-heroicon-s-plus class="h-5 w-5 inline mr-1" />
            Buat Misi Harian Baru
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if ($dailyMissions->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul Misi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tasks
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total XP
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($dailyMissions as $dailyMission)
                            @php
                                $date = $dailyMission->date ? \Carbon\Carbon::parse($dailyMission->date) : null;
                            @endphp

                            <tr class="hover:bg-gray-50 {{ $date && $date->isToday() ? 'bg-blue-50' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $date ? $date->format('d M Y') : '-' }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $date ? $date->format('l') : '-' }}
                                            </div>
                                        </div>

                                        @if ($date && $date->isToday())
                                            <span class="ml-2 inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Hari Ini
                                            </span>
                                        @elseif ($date && $date->isFuture())
                                            <span class="ml-2 inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Mendatang
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $dailyMission->title }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ Str::limit($dailyMission->description, 60) }}
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col space-y-1">
                                        @foreach ($dailyMission->tasks as $task)
                                            <div class="flex items-center">
                                                @if ($task->type === 'read')
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        📖 Baca
                                                    </span>
                                                @elseif ($task->type === 'engage')
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                                        💬 Engage
                                                    </span>
                                                @elseif ($task->type === 'quiz')
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        🧠 Quiz
                                                    </span>
                                                @endif

                                                <span class="ml-2 text-xs text-gray-500">{{ $task->xp_reward }} XP</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $dailyMission->tasks->sum('xp_reward') }} XP
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($date && $date->isPast() && !$date->isToday())
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Selesai
                                        </span>
                                    @elseif ($date && $date->isToday())
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Dijadwalkan
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.daily-missions.show', $dailyMission) }}"
                                            class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                            <x-heroicon-s-eye class="h-4 w-4" />
                                        </a>

                                        <a href="{{ route('admin.daily-missions.edit', $dailyMission) }}"
                                            class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                            <x-heroicon-s-pencil class="h-4 w-4" />
                                        </a>

                                        @if ($date && $date->isFuture())
                                            <form action="{{ route('admin.daily-missions.destroy', $dailyMission) }}" 
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Yakin ingin menghapus misi harian ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                                    <x-heroicon-s-trash class="h-4 w-4" />
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            @if ($dailyMissions->hasPages())
                <div class="px-6 py-3 border-t border-gray-200">
                    {{ $dailyMissions->links() }}
                </div>
            @endif

        @else
            <div class="text-center py-12">
                <x-heroicon-o-calendar-days class="mx-auto h-12 w-12 text-gray-400" />
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada misi harian</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat misi harian pertama Anda.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.daily-missions.create') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#0F766E] hover:bg-[#0d6f64]">
                        <x-heroicon-s-plus class="-ml-1 mr-2 h-5 w-5" />
                        Buat Misi Harian Baru
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
