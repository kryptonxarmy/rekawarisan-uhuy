@extends('frontend.layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>

    @if($article->cover)
        <img src="{{ asset($article->cover) }}" alt="{{ $article->title }}" class="w-full rounded mb-6">
    @endif

    <div class="prose max-w-none">{!! $article->body !!}</div>

    <div class="mt-6 text-sm text-gray-500">Dilihat: {{ $article->views }}</div>
</div>
@endsection
