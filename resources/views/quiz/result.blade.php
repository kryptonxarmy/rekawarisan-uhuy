@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-16 text-center">

    <h1 class="text-4xl font-extrabold text-purple-600 mb-4">Hasil Quiz 🎉</h1>

    <div class="p-8 bg-white rounded-2xl shadow-xl border-l-8 border-purple-500">
        <p class="text-2xl font-semibold mb-2">
            Skor Kamu: <span class="text-green-600">{{ $score }}</span>
        </p>

        <p class="text-xl font-medium">
            Bonus Kartu: <span class="text-yellow-500">{{ $bonus }}</span>
        </p>

        <p class="text-3xl font-bold mt-3">
            Total: <span class="text-blue-600">{{ $total }}</span>
        </p>
    </div>

    <a href="{{ route('quiz.index') }}"
       class="inline-block mt-6 px-6 py-3 bg-purple-600 text-white rounded-xl shadow hover:bg-purple-700 transition">
        Kembali ke daftar quiz
    </a>
</div>
@endsection
