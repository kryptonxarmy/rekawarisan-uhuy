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
                <p class="text-gray-600">
                    {{ $dailyMission->date?->format('d F Y') ?? 'Tanggal belum diisi' }} 
                    @if($dailyMission->date)
                        - {{ $dailyMission->date->format('l') }}
                    @endif
                </p>
            </div>
        </div>

        <div class="flex space-x-3">
            @if($dailyMission->date?->isFuture())
                <a href="{{ route('admin.daily-missions.edit', $dailyMission) }}"
                   class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors">
                    <x-heroicon-s-pencil class="h-5 w-5 inline mr-1" /> Edit
                </a>
            @endif

            @if($dailyMission->date?->isToday())
                <span class="bg-green-100 text-green-800 px-3 py-2 rounded-lg font-medium">
                    ✨ Aktif Hari Ini
                </span>
            @elseif($dailyMission->date?->isFuture())
                <span class="bg-blue-100 text-blue-800 px-3 py-2 rounded-lg font-medium">
                    Jadwal Mendatang
                </span>
            @endif
        </div>
    </div>

    <!-- Tambahkan konten detail misi lainnya di sini -->

</div>
@endsection
