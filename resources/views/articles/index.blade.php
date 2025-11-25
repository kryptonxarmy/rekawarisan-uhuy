@extends('layouts.app')
@section('content')
    <h1>Daftar Artikel (Enduser)</h1>
    <ul>
        @foreach ($articles as $article)
            <li>
                <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
            </li>
        @endforeach
    </ul>
@endsection
