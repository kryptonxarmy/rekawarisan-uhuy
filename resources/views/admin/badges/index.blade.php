@extends('admin.AdminLayout')

@section('content')
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-[#0F766E]">Kelola Badge</h1>
                <p class="text-gray-600 mt-2">Kelola sistem penghargaan dan pencapaian pengguna</p>
            </div>
            <a href="{{ route('admin.badges.create') }}" 
               class="bg-[#0F766E] text-white px-6 py-3 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
                <x-heroicon-s-plus class="h-5 w-5" />
                Buat Badge Baru
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Badges Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($badges as $badge)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                <!-- Badge Header -->
                <div class="relative p-6 pb-4" style="background: linear-gradient(135deg, {{ $badge->color }}15 0%, {{ $badge->color }}05 100%);">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="h-12 w-12 rounded-full flex items-center justify-center" 
                                 style="background-color: {{ $badge->color }}20;">
                                @if($badge->icon === 'star')
                                    <x-heroicon-s-star class="h-6 w-6" style="color: {{ $badge->color }}" />
                                @elseif($badge->icon === 'book-open')
                                    <x-heroicon-s-book-open class="h-6 w-6" style="color: {{ $badge->color }}" />
                                @elseif($badge->icon === 'trophy')
                                    <x-heroicon-s-trophy class="h-6 w-6" style="color: {{ $badge->color }}" />
                                @else
                                    <x-heroicon-s-star class="h-6 w-6" style="color: {{ $badge->color }}" />
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $badge->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $badge->users_count }} pengguna</p>
                            </div>
                        </div>
                        
                        <!-- XP Reward -->
                        <div class="text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                +{{ $badge->xp_reward }} XP
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Badge Content -->
                <div class="p-6 pt-2">
                    <!-- Description -->
                    <p class="text-gray-700 mb-4">{{ $badge->description }}</p>
                    
                    <!-- Requirements -->
                    <div class="bg-gray-50 rounded-lg p-3 mb-4">
                        <h4 class="text-sm font-semibold text-gray-900 mb-1">Syarat:</h4>
                        <p class="text-sm text-gray-600">{{ $badge->requirements }}</p>
                    </div>
                    
                    <!-- Stats -->
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span>Dibuat: {{ $badge->created_at->format('d M Y') }}</span>
                        <span class="flex items-center">
                            <x-heroicon-s-users class="h-4 w-4 mr-1" />
                            {{ $badge->users_count }} pengguna
                        </span>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.badges.show', $badge->id) }}" 
                               class="text-[#0F766E] hover:text-[#0F766E]/80 text-sm font-medium">
                                Lihat Detail
                            </a>
                            <a href="{{ route('admin.badges.edit', $badge->id) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Edit
                            </a>
                        </div>
                        
                        <form action="{{ route('admin.badges.destroy', $badge->id) }}" 
                              method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus badge ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        
        @if($badges->isEmpty())
            <!-- Empty State -->
            <div class="col-span-full">
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <div class="flex flex-col items-center">
                        <x-heroicon-o-star class="h-16 w-16 text-gray-400 mb-4" />
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada badge</h3>
                        <p class="text-gray-500 mb-6">Mulai buat badge pertama untuk sistem penghargaan pengguna.</p>
                        <a href="{{ route('admin.badges.create') }}" 
                           class="bg-[#0F766E] text-white px-6 py-3 rounded-lg hover:bg-[#0F766E]/90 flex items-center gap-2">
                            <x-heroicon-s-plus class="h-5 w-5" />
                            Buat Badge Pertama
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Quick Stats Card -->
    <div class="mt-8 bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Badge</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="text-3xl font-bold text-[#0F766E]">{{ $badges->count() }}</div>
                <div class="text-sm text-gray-600">Total Badge</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-blue-600">{{ $badges->sum('users_count') }}</div>
                <div class="text-sm text-gray-600">Badge Diperoleh</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-yellow-600">{{ $badges->sum('xp_reward') }}</div>
                <div class="text-sm text-gray-600">Total XP Reward</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600">
                    {{ $badges->isNotEmpty() ? number_format($badges->avg('users_count'), 1) : '0' }}
                </div>
                <div class="text-sm text-gray-600">Rata-rata Pengguna</div>
            </div>
        </div>
    </div>
@endsection
