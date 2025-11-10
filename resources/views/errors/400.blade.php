<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>400 | Bad Request</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-8px); }
      75% { transform: translateX(8px); }
    }
    .animate-shake { animation: shake 0.4s ease-in-out 1; }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-b from-yellow-50 to-yellow-100">

  <div class="text-center animate-shake px-6">
    <div class="flex justify-center mb-8">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 text-yellow-600 md:w-40 md:h-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 10h.01M15 10h.01M8 16h8m-4-2v2" />
      </svg>
    </div>

    <h1 class="text-9xl md:text-[160px] font-extrabold text-yellow-700">400</h1>
    <p class="text-2xl md:text-3xl font-semibold text-yellow-700 mt-4">Bad Request</p>
    <p class="text-yellow-600 mt-2 text-lg md:text-xl">The server could not understand your request.</p>

    <a href="{{ url('/') }}" class="inline-block mt-10 px-10 py-4 bg-yellow-600 text-white text-lg md:text-xl font-medium rounded-md shadow-lg hover:bg-yellow-700 transition duration-300">
      Try Again
    </a>
  </div>

</body>
</html>
