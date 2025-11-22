@extends('frontend.layout.app', ['title' => 'Pustaka Warisan'])
@section('content')
    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-3">
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Lokakarya</a>
                <span>›</span>
                <a href="/" class="hover:text-teal-600">Pustaka Warisan</a>
                <span>›</span>
                <a href="#" class="hover:text-teal-600">Tari tarian</a>
                <span>›</span>
                <span class="text-gray-900">Budaya Suku Gayo Aceh</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Content -->
            <div class="lg:col-span-2">
                <!-- Title Section -->
                <div class="mb-6">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                        <span>Kategori: <span class="text-teal-600 font-semibold">{{ $article->category->name }}</span></span>
                        <span>Provinsi: <span class="text-teal-600 font-semibold">{{ $article->province ?? '-' }}</span></span>
                        <span>Ditulis Oleh: <span class="text-teal-600 font-semibold">{{ $article->author->name ?? 'Admin' }}</span></span>
                        <span class="flex items-center">👁️ {{ number_format($article->view_count) }} Dilihat</span>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="mb-8">
                    <img src="{{ $article->img_url ? asset($article->img_url) : asset('images/default.jpg') }}" 
                        alt="{{ $article->title }}" class="w-full rounded-lg shadow-md">
                </div>

                <!-- Content -->
                <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                    <div class="prose max-w-none">
                        {!! $article->content !!}
                    </div>

                    <!-- Social Actions -->
                    <div class="flex items-center gap-4 mt-8 pt-6 border-t">
                        <form action="{{ route('articles.like', $article->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 text-gray-600 hover:text-teal-600">
                                ❤️ <span>{{ $article->like_count }}</span> Suka
                            </button>
                        </form>

                        <button class="flex items-center gap-2 text-gray-600 hover:text-teal-600" onclick="document.getElementById('comment-form').scrollIntoView();">
                            ↗️ Komentar <span>{{ $article->comments->count() }}</span>
                        </button>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Komentar</h3>
                        <button class="text-teal-600 hover:text-teal-700 font-semibold" onclick="document.getElementById('comment-form').scrollIntoView();">+ Tambahkan Komentar</button>
                    </div>

                    <!-- Comment Form -->
                <form id="comment-form" action="{{ route('articles.comment', $article->id) }}" method="POST">
                    @csrf
                    <textarea name="comment_content" rows="3" placeholder="Tulis komentar..."></textarea>
                    <button type="submit">Kirim Komentar</button>
                </form>


                    <!-- Comment Items -->
                    <div class="space-y-6">
                        @foreach($article->comments as $comment)
                            <div>
                                <strong>{{ $comment->user->name }}</strong>:
                                <p>{{ $comment->content }}</p>
                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Related Articles -->
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Artikel Budaya Terkait</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedArticles as $rel)
                            <a href="{{ route('pustakawarisan.show', $rel->id) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                                <div class="relative h-32">
                                    <img src="{{ $rel->img_url ? asset($rel->img_url) : asset('images/default.jpg') }}" 
                                        alt="{{ $rel->title }}" class="w-full h-full object-cover">
                                    <span class="absolute top-2 left-2 bg-yellow-400 text-yellow-900 px-2 py-1 rounded-full text-xs font-semibold">
                                        {{ $rel->category->name }}
                                    </span>
                                </div>
                                <div class="p-3">
                                    <h4 class="font-bold text-gray-800 text-sm mb-2">{{ $rel->title }}</h4>
                                    <p class="text-gray-600 text-xs mb-3">{{ Str::limit(strip_tags($rel->content), 60) }}</p>
                                    <button class="text-teal-600 text-xs font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="lg:col-span-1">
<div class="bg-teal-700 text-white rounded-lg shadow-lg p-6 sticky top-4 space-y-6">

    <!-- Fun Fact -->
    <div>
        <h3 class="text-2xl font-bold mb-4">Fun Fact</h3>
        <div class="space-y-3">
            <div>
                <h4 class="font-bold mb-1">🕺 Tari Saman</h4>
                <p class="text-sm text-teal-50">Tari Saman dilakukan tanpa alat musik, hanya suara dan gerakan tubuh.</p>
            </div>
            <div>
                <h4 class="font-bold mb-1">🌏 Bahasa Aceh</h4>
                <p class="text-sm text-teal-50">Bahasa Aceh memiliki lebih dari 7 dialek yang berbeda tergantung daerahnya.</p>
            </div>
            <div>
                <h4 class="font-bold mb-1">🎉 Festival Budaya</h4>
                <p class="text-sm text-teal-50">Beberapa festival diadakan tiap tahun untuk melestarikan tarian dan musik tradisional.</p>
            </div>
        </div>
    </div>

    <!-- Artikel Terkait -->
    <div>
        <h3 class="text-2xl font-bold mb-4">Artikel Terkait</h3>
        <div class="space-y-2 text-sm">
            @foreach($relatedArticles as $rel)
                <a href="{{ route('pustakawarisan.show', $rel->id) }}" class="block hover:text-teal-200 bg-white text-gray-900 rounded-lg shadow-lg p-6">
                    {{ Str::limit($rel->title, 40) }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Bagian Share di bawah artikel -->
    <div class="mt-8 flex items-center gap-4">
        <span class="font-semibold text-gray-700">Bagikan Artikel:</span>

        <!-- WhatsApp -->
        <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' ' . request()->fullUrl()) }}" 
        target="_blank" 
        class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.52 3.48A11.88 11.88 0 0012 0C5.37 0 .03 5.33.03 12c0 2.12.55 4.14 1.6 5.92L0 24l6.34-1.63A11.88 11.88 0 0012 24c6.63 0 12-5.33 12-12a11.88 11.88 0 00-3.48-8.52zM12 22c-1.85 0-3.63-.5-5.16-1.44l-.37-.22-3.77.97.94-3.66-.24-.38A9.94 9.94 0 012 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.2-7.1c-.28-.14-1.66-.82-1.92-.91-.26-.09-.45-.14-.64.14s-.73.91-.9 1.1-.33.21-.61.07a8.54 8.54 0 01-2.52-1.55 9.16 9.16 0 01-1.68-2.08c-.18-.31 0-.48.13-.63.14-.14.31-.33.46-.5.15-.17.2-.28.3-.47.1-.18.05-.33-.02-.47-.07-.14-.64-1.54-.88-2.11-.23-.55-.46-.47-.64-.48l-.54-.01c-.18 0-.47.07-.72.33s-.95.92-.95 2.24 1 2.6 1.13 2.78c.14.18 1.95 2.98 4.72 4.17.66.28 1.18.45 1.58.58.66.22 1.26.19 1.73.12.53-.08 1.66-.68 1.9-1.34.23-.65.23-1.2.16-1.32-.07-.11-.26-.18-.54-.32z"/>
            </svg>
            WhatsApp
        </a>

        <!-- Instagram -->
        <a href="https://www.instagram.com/?url={{ urlencode(request()->fullUrl()) }}" 
        target="_blank" 
        class="flex items-center gap-2 bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2.16c3.2 0 3.584.012 4.85.07 1.17.054 1.95.24 2.41.406a4.92 4.92 0 011.8 1.03 4.92 4.92 0 011.03 1.8c.166.462.352 1.24.406 2.41.058 1.266.07 1.65.07 4.85s-.012 3.584-.07 4.85c-.054 1.17-.24 1.95-.406 2.41a4.92 4.92 0 01-1.03 1.8 4.92 4.92 0 01-1.8 1.03c-.462.166-1.24.352-2.41.406-1.266.058-1.65.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.054-1.95-.24-2.41-.406a4.92 4.92 0 01-1.8-1.03 4.92 4.92 0 01-1.03-1.8c-.166-.462-.352-1.24-.406-2.41C2.172 15.584 2.16 15.2 2.16 12s.012-3.584.07-4.85c.054-1.17.24-1.95.406-2.41a4.92 4.92 0 011.03-1.8 4.92 4.92 0 011.8-1.03c.462-.166 1.24-.352 2.41-.406C8.416 2.172 8.8 2.16 12 2.16zm0-2.16C8.737 0 8.332.012 7.052.07 5.775.127 4.842.308 4.052.558a6.873 6.873 0 00-2.49 1.622A6.873 6.873 0 00.558 4.052C.308 4.842.127 5.775.07 7.052.012 8.332 0 8.737 0 12c0 3.263.012 3.668.07 4.948.057 1.277.238 2.21.488 3a6.873 6.873 0 001.622 2.49 6.873 6.873 0 002.49 1.622c.79.25 1.723.431 3 .488C8.332 23.988 8.737 24 12 24s3.668-.012 4.948-.07c1.277-.057 2.21-.238 3-.488a6.873 6.873 0 002.49-1.622 6.873 6.873 0 001.622-2.49c.25-.79.431-1.723.488-3 .058-1.28.07-1.685.07-4.948s-.012-3.668-.07-4.948c-.057-1.277-.238-2.21-.488-3a6.873 6.873 0 00-1.622-2.49 6.873 6.873 0 00-2.49-1.622c-.79-.25-1.723-.431-3-.488C15.668.012 15.263 0 12 0z"/>
                <path d="M12 5.838A6.162 6.162 0 105.838 12 6.162 6.162 0 0012 5.838zm0 10.162A4 4 0 1116 12a4 4 0 01-4 4zm6.406-11.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
            </svg>
            Instagram
        </a>
    </div>

</div>



            </div>
        </div>
    </div>
@endsection
