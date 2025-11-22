<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Quiz Pilihan Ganda
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4">Daftar Soal</h3>

                @if ($quizzes->count() == 0)
                    <p class="text-gray-500">Belum ada soal quiz.</p>
                @else
                    @foreach ($quizzes as $q)
                        <div class="border-b py-3">
                            <p class="font-semibold">{{ $q->question }}</p>

                            <ul class="list-disc ml-6 text-sm text-gray-700">
                                <li>A. {{ $q->option_a }}</li>
                                <li>B. {{ $q->option_b }}</li>

                                @if ($q->option_c)
                                    <li>C. {{ $q->option_c }}</li>
                                @endif

                                @if ($q->option_d)
                                    <li>D. {{ $q->option_d }}</li>
                                @endif
                            </ul>
                        </div>
                    @endforeach
                @endif

                <div class="mt-6">
                    <a href="/quiz/play"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Mulai Quiz
                    </a>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
