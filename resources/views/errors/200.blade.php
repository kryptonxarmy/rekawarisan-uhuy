<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>200 | Success</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }
    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.05); opacity: 0.9; }
    }
    .animate-fadeIn { animation: fadeIn 1s ease-out forwards; }
    .animate-pulse { animation: pulse 2s ease-in-out infinite; }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-b from-green-50 to-green-100">

  <div class="text-center animate-fadeIn px-6">
    <div class="flex justify-center mb-8 animate-pulse">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 text-green-600 md:w-40 md:h-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"/>
        <path d="M9 12l2 2l4 -4"/>
      </svg>
    </div>

    <h1 class="text-9xl md:text-[160px] font-extrabold text-green-700">200</h1>
    <p class="text-2xl md:text-3xl font-semibold text-green-700 mt-4">Success!</p>
    <p class="text-green-600 mt-2 text-lg md:text-xl">Your request has been processed successfully.</p>

    <a href="{{ url('/') }}" class="inline-block mt-10 px-10 py-4 bg-green-600 text-white text-lg md:text-xl font-medium rounded-md shadow-lg hover:bg-green-700 transition duration-300">
      Go Home
    </a>
  </div>

</body>
</html>
