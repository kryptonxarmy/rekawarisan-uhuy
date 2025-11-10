<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>500 | Server Error</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.05); opacity: 0.8; }
    }
    
  </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-b from-red-50 to-red-100">

  <div class="text-center animate-pulseCustom px-6">
    <div class="flex justify-center mb-8">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 text-red-600 md:w-40 md:h-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01" />
      </svg>
    </div>

    <h1 class="text-9xl md:text-[160px] font-extrabold text-red-700">500</h1>
    <p class="text-2xl md:text-3xl font-semibold text-red-700 mt-4">Server Error</p>
    <p class="text-red-600 mt-2 text-lg md:text-xl">Oops! Something went wrong on our server.</p>

    <a href="{{ url('/') }}" class="inline-block mt-10 px-10 py-4 bg-red-600 text-white text-lg md:text-xl font-medium rounded-md shadow-lg hover:bg-red-700 transition duration-300">
      Reload Page
    </a>
  </div>

</body>
</html>
