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
    
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#0F766E] opacity-60">Kelola Misi (Old System)</h1>
            <p class="text-gray-600">Kelola misi Jejak Maestro di sini (Sistem Lama - Deprecated).</p>
        </div>
        <a href="{{ route('admin.missions.create') }}"
            class="bg-[#0F766E] text-white px-4 py-2 rounded-md hover:bg-[#0d6f64] transition-colors">
            <x-heroicon-s-plus class="h-5 w-5 inline mr-1" />
            Buat Misi Baru
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
        @if ($missions->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Misi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipe
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                XP Reward
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dibuat Oleh
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($missions as $mission)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $mission->title }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ Str::limit($mission->description, 60) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $mission->type === 'read'
                                            ? 'bg-blue-100 text-blue-800'
                                            : 'bg-purple-100 text-purple-800' }}">
                                        {{ ucfirst($mission->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($mission->xp_reward) }} XP
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $mission->status === 'active'
                                            ? 'bg-green-100 text-green-800'
                                            : ($mission->status === 'inactive'
                                                ? 'bg-red-100 text-red-800'
                                                : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($mission->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $mission->creator->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.missions.show', $mission) }}"
                                            class="text-blue-600 hover:text-blue-900">
                                            <x-heroicon-s-eye class="h-4 w-4" />
                                        </a>
                                        <a href="{{ route('admin.missions.edit', $mission) }}"
                                            class="text-yellow-600 hover:text-yellow-900">
                                            <x-heroicon-s-pencil class="h-4 w-4" />
                                        </a>
                                        <form action="{{ route('admin.missions.destroy', $mission) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin ingin menghapus misi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <x-heroicon-s-trash class="h-4 w-4" />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <x-heroicon-o-clipboard-document-list class="mx-auto h-12 w-12 text-gray-400" />
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada misi</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat misi pertama Anda.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.missions.create') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#0F766E] hover:bg-[#0d6f64]">
                        <x-heroicon-s-plus class="-ml-1 mr-2 h-5 w-5" />
                        Buat Misi Baru
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
