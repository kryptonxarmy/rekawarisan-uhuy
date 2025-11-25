@extends('admin.AdminLayout')

@section('content')
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-[#0F766E]">Kotak Masuk</h1>
                <p class="text-gray-600 mt-2">Kelola pesan dan feedback dari pengguna</p>
            </div>
            
            <!-- Stats Cards -->
            <div class="flex gap-4">
                <div class="bg-white rounded-lg shadow px-4 py-3">
                    <div class="flex items-center">
                        <div class="h-8 w-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <x-heroicon-s-envelope class="h-4 w-4 text-blue-600" />
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Total</p>
                            <p class="text-lg font-bold text-gray-900">{{ $stats->total }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow px-4 py-3">
                    <div class="flex items-center">
                        <div class="h-8 w-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                            <x-heroicon-s-envelope-open class="h-4 w-4 text-orange-600" />
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Belum Dibaca</p>
                            <p class="text-lg font-bold text-gray-900">{{ $stats->unread }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow px-4 py-3">
                    <div class="flex items-center">
                        <div class="h-8 w-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                            <x-heroicon-s-star class="h-4 w-4 text-red-600" />
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Penting</p>
                            <p class="text-lg font-bold text-gray-900">{{ $stats->important }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <h3 class="text-lg font-semibold text-gray-900">Filter Pesan</h3>
            
            <div class="flex gap-2">
                <a href="{{ route('admin.inbox.index', ['filter' => 'all']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ $filter === 'all' ? 'bg-[#0F766E] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Semua
                </a>
                <a href="{{ route('admin.inbox.index', ['filter' => 'unread']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ $filter === 'unread' ? 'bg-[#0F766E] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Belum Dibaca
                    @if($stats->unread > 0)
                        <span class="ml-2 bg-orange-500 text-white text-xs px-2 py-1 rounded-full">{{ $stats->unread }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.inbox.index', ['filter' => 'read']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ $filter === 'read' ? 'bg-[#0F766E] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Sudah Dibaca
                </a>
                <a href="{{ route('admin.inbox.index', ['filter' => 'important']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ $filter === 'important' ? 'bg-[#0F766E] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Penting
                    @if($stats->important > 0)
                        <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $stats->important }}</span>
                    @endif
                </a>
            </div>
        </div>
    </div>

    <!-- Messages List -->
    <div class="bg-white rounded-lg shadow">
        @if($messages->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($messages as $message)
                    <div class="p-6 hover:bg-gray-50 transition-colors 
                        {{ !$message->is_read ? 'bg-blue-50' : '' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4 flex-1">
                                <!-- Avatar -->
                                <div class="flex-shrink-0">
                                    <img src="{{ $message->sender_avatar }}" 
                                         alt="{{ $message->sender_name }}" 
                                         class="h-12 w-12 rounded-full">
                                </div>
                                
                                <!-- Message Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-2">
                                            <h3 class="text-lg font-semibold text-gray-900 
                                                {{ !$message->is_read ? 'font-bold' : '' }}">
                                                {{ $message->subject }}
                                            </h3>
                                            
                                            <!-- Type Badge -->
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $message->type === 'question' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $message->type === 'suggestion' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $message->type === 'report' ? 'bg-red-100 text-red-800' : '' }}
                                                {{ $message->type === 'other' ? 'bg-gray-100 text-gray-800' : '' }}">
                                                {{ ucfirst($message->type) }}
                                            </span>
                                            
                                            <!-- Category Badge -->
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $message->category }}
                                            </span>
                                            
                                            <!-- Important Badge -->
                                            @if($message->is_important)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <x-heroicon-s-star class="h-3 w-3 mr-1" />
                                                    Penting
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <!-- Timestamp -->
                                        <div class="text-sm text-gray-500">
                                            {{ $message->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    
                                    <!-- Sender Info -->
                                    <div class="flex items-center text-sm text-gray-600 mb-3">
                                        <span class="font-medium">{{ $message->sender_name }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $message->sender_email }}</span>
                                    </div>
                                    
                                    <!-- Message Preview -->
                                    <p class="text-gray-700 line-clamp-2">
                                        {{ Str::limit($message->message, 200) }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex items-center space-x-2 ml-4">
                                @if(!$message->is_read)
                                    <button onclick="markAsRead({{ $message->id }})" 
                                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Tandai Dibaca
                                    </button>
                                @endif
                                
                                <a href="{{ route('admin.inbox.show', $message->id) }}" 
                                   class="text-[#0F766E] hover:text-[#0F766E]/80 text-sm font-medium">
                                    Lihat Detail
                                </a>
                                
                                <form action="{{ route('admin.inbox.destroy', $message->id) }}" 
                                      method="POST" class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
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
            </div>
        @else
            <div class="p-12 text-center">
                <div class="flex flex-col items-center">
                    <x-heroicon-o-inbox class="h-16 w-16 text-gray-400 mb-4" />
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada pesan</h3>
                    <p class="text-gray-500">
                        @if($filter === 'unread')
                            Semua pesan sudah dibaca.
                        @elseif($filter === 'important')
                            Tidak ada pesan penting.
                        @else
                            Belum ada pesan masuk.
                        @endif
                    </p>
                </div>
            </div>
        @endif
    </div>

    <script>
        function markAsRead(messageId) {
            fetch(`{{ url('admin/inbox') }}/${messageId}/mark-read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
