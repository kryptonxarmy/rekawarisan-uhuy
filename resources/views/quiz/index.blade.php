<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Nusantara - Premium Edition</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
            color: white;
        }

        /* --- 1. BACKGROUND BATIK MODERN (CSS GENERATED) --- */
        /* Tidak pakai gambar luar biar tidak pecah */
        .batik-modern-bg {
            background-color: #1a0518; /* Dasar Gelap Ungu/Coklat */
            opacity: 1;
            background-image:  
                radial-gradient(#3d1832 2px, transparent 2.5px), 
                radial-gradient(#3d1832 2px, transparent 2.5px);
            background-size: 30px 30px;
            background-position: 0 0, 15px 15px;
            /* Vignette effect biar fokus ke tengah */
            box-shadow: inset 0 0 150px rgba(0,0,0,0.9); 
        }

        /* --- 2. CARD JAWABAN --- */
        .answer-card {
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border-bottom-width: 6px;
            /* Shadow halus */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }

        .answer-card:active:not(:disabled) {
            transform: translateY(4px);
            border-bottom-width: 2px;
            box-shadow: none;
        }

        /* --- 3. FEEDBACK WARNA (PENTING!) --- */
        /* Hijau Neon Terang untuk Benar */
        .correct-answer {
            background-color: #00e676 !important; /* Neon Green */
            border-color: #00a152 !important;
            color: #052e16 !important; /* Teks jadi gelap biar kontras */
            box-shadow: 0 0 30px rgba(0, 230, 118, 0.6) !important;
            transform: scale(1.02);
            z-index: 20;
        }

        /* Merah Gelap untuk Salah */
        .wrong-answer {
            background-color: #ef4444 !important;
            border-color: #991b1b !important;
            color: white !important;
            opacity: 0.6;
            transform: scale(0.95);
        }

        /* --- 4. POWER UP ICONS --- */
        .power-btn {
            transition: all 0.2s;
            border-bottom: 4px solid rgba(0,0,0,0.3);
        }
        .power-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            filter: brightness(1.2);
        }
        .power-btn:active:not(:disabled) {
            transform: translateY(2px);
            border-bottom-width: 0px;
        }
        
        /* Tooltip Style */
        .tooltip-box {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            bottom: 110%;
        }
        .group:hover .tooltip-box {
            opacity: 1;
            visibility: visible;
            bottom: 125%; /* Efek naik sedikit */
        }

        /* --- 5. ANIMATIONS --- */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .floating-ui { animation: float 6s ease-in-out infinite; }
    </style>
</head>
<body class="batik-modern-bg min-h-screen flex flex-col p-4 md:p-6">

    <div class="w-full max-w-7xl mx-auto grid grid-cols-3 items-center mb-4 relative z-20">
        
        <div class="flex items-center col-span-1">
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-2 pr-6 flex items-center gap-4 shadow-xl">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center shadow-lg border-2 border-white/30">
                    <span class="text-2xl">👤</span>
                </div>
                <div>
                    <p class="text-xs text-purple-200 uppercase font-bold tracking-wider mb-0.5">Pemain</p>
                    <h3 class="text-lg md:text-xl font-bold text-white leading-none truncate max-w-[120px] md:max-w-[200px]">
                        Mohammad Aden
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-span-1 flex justify-center">
            <div class="relative w-24 h-24 flex items-center justify-center bg-gray-900 rounded-full border-[6px] border-yellow-500 shadow-[0_0_40px_rgba(234,179,8,0.3)] z-30">
                <span id="timer" class="text-5xl font-black text-yellow-400 tracking-tighter">15</span>
                <div class="absolute -bottom-3 bg-yellow-500 text-black text-[10px] font-black px-3 py-0.5 rounded-full uppercase">Detik</div>
            </div>
        </div>

        <div class="flex items-center justify-end col-span-1">
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-2 pl-6 flex items-center flex-row-reverse gap-4 shadow-xl text-right">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center shadow-lg border-2 border-white/30">
                    <span class="text-2xl text-black">⭐</span>
                </div>
                <div>
                    <p class="text-xs text-yellow-200 uppercase font-bold tracking-wider mb-0.5">Total Poin</p>
                    <h3 id="score" class="text-2xl md:text-3xl font-black text-yellow-400 leading-none">
                        0
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-grow flex flex-col justify-center w-full max-w-6xl mx-auto relative z-10">
        
        <div class="w-full bg-black/40 backdrop-blur-lg border-y-2 border-white/10 py-10 px-6 md:px-12 text-center mb-8 relative rounded-3xl shadow-2xl">
            <div class="absolute -top-5 left-1/2 transform -translate-x-1/2 bg-indigo-600 text-white px-6 py-2 rounded-full font-bold text-sm shadow-lg border-2 border-indigo-400">
                PERTANYAAN <span id="current-question-num">1</span> / <span id="total-questions">5</span>
            </div>
            
            <h2 id="question-text" class="text-2xl md:text-4xl font-bold leading-snug text-white drop-shadow-md mt-2">
                Loading Question...
            </h2>
        </div>

        <div id="options-container" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            </div>

    </div>

    <div class="w-full max-w-3xl mx-auto mt-6 mb-2">
        <div class="bg-black/30 backdrop-blur-md rounded-full p-3 flex justify-center gap-8 border border-white/5 shadow-2xl">
            
            <div class="group relative">
                <div class="tooltip-box absolute left-1/2 transform -translate-x-1/2 bg-white text-gray-900 text-xs font-bold px-3 py-2 rounded-lg shadow-xl whitespace-nowrap z-50">
                    Hilangkan 2 Jawaban Salah
                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-white"></div>
                </div>
                <button id="help-1" onclick="useHelp(1)" class="power-btn w-16 h-16 bg-gradient-to-b from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg border-blue-800">
                    <span class="text-xl font-black italic text-white drop-shadow-md">50:50</span>
                </button>
            </div>

            <div class="group relative">
                <div class="tooltip-box absolute left-1/2 transform -translate-x-1/2 bg-white text-gray-900 text-xs font-bold px-3 py-2 rounded-lg shadow-xl whitespace-nowrap z-50">
                    Tambah +10 Detik
                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-white"></div>
                </div>
                <button id="help-2" onclick="useHelp(2)" class="power-btn w-16 h-16 bg-gradient-to-b from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg border-orange-800">
                    <svg class="w-8 h-8 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </button>
            </div>

            <div class="group relative">
                <div class="tooltip-box absolute left-1/2 transform -translate-x-1/2 bg-white text-gray-900 text-xs font-bold px-3 py-2 rounded-lg shadow-xl whitespace-nowrap z-50">
                    Kebal 1x Kesalahan
                    <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-white"></div>
                </div>
                <button id="help-3" onclick="useHelp(3)" class="power-btn w-16 h-16 bg-gradient-to-b from-teal-400 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg border-teal-800">
                    <svg class="w-8 h-8 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </button>
            </div>

        </div>
    </div>

    <div id="results-modal" class="hidden fixed inset-0 bg-black/90 flex items-center justify-center z-50 backdrop-blur-lg">
        <div class="bg-gray-900 border border-white/10 rounded-3xl p-12 text-center max-w-md w-full mx-4 shadow-2xl floating-ui">
            
            <h2 class="text-3xl font-bold text-white mb-2">Permainan Selesai!</h2>
            <p class="text-gray-400 mb-8">Poin yang berhasil kamu kumpulkan:</p>
            
            <div class="relative py-6 mb-8">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent"></div>
                <div class="text-8xl font-black text-transparent bg-clip-text bg-gradient-to-b from-yellow-300 to-yellow-600 tracking-widest drop-shadow-sm" id="final-score-display">
                    0
                </div>
            </div>

            <button onclick="backToHome()" class="w-full bg-white text-black py-4 rounded-xl font-black text-xl hover:bg-gray-200 transition-all shadow-[0_0_30px_rgba(255,255,255,0.3)] tracking-wide">
                KEMBALI
            </button>
        </div>
    </div>

    <script>
        // === DATA SOAL ===
        const questions = [
            {
                question: "Ciri dari UI yang baik adalah...",
                options: { A: "Banyak animasi ribet", B: "Warna tabrakan", C: "Navigasi mudah dipahami", D: "Font tidak terbaca" },
                correct: "C"
            },
            {
                question: "Framework PHP populer saat ini?",
                options: { A: "React", B: "Laravel", C: "Vue", D: "Flutter" },
                correct: "B"
            },
            {
                question: "Ibukota Indonesia saat ini adalah?",
                options: { A: "Bandung", B: "Surabaya", C: "Jakarta", D: "Medan" },
                correct: "C"
            },
            {
                question: "Warna bendera Indonesia?",
                options: { A: "Merah Putih", B: "Putih Merah", C: "Merah Biru", D: "Putih Hijau" },
                correct: "A"
            },
             {
                question: "Alat musik petik tradisional?",
                options: { A: "Gendang", B: "Suling", C: "Sasando", D: "Bonang" },
                correct: "C"
            }
        ];

        // Warna Button Solid (A, B, C, D)
        const colors = [
            'bg-[#ef4444] border-[#b91c1c]', // Merah
            'bg-[#3b82f6] border-[#1d4ed8]', // Biru
            'bg-[#f59e0b] border-[#b45309]', // Kuning/Orange
            'bg-[#8b5cf6] border-[#6d28d9]'  // Ungu
        ];

        let state = {
            idx: 0,
            score: 0,
            timer: 15,
            interval: null,
            isAnswered: false,
            protection: false, // Shield status
            helps: {1: false, 2: false, 3: false}
        };

        const els = {
            qText: document.getElementById('question-text'),
            qNum: document.getElementById('current-question-num'),
            totalQ: document.getElementById('total-questions'),
            opts: document.getElementById('options-container'),
            score: document.getElementById('score'),
            timer: document.getElementById('timer'),
            modal: document.getElementById('results-modal'),
            finalScore: document.getElementById('final-score-display')
        };

        function init() {
            els.totalQ.textContent = questions.length;
            loadQuestion();
        }

        function loadQuestion() {
            if (state.idx >= questions.length) return finish();

            const q = questions[state.idx];
            els.qText.textContent = q.question;
            els.qNum.textContent = state.idx + 1;
            state.isAnswered = false;
            state.protection = false; // Reset shield per round logic (optional)
            
            els.opts.innerHTML = '';
            Object.keys(q.options).forEach((key, i) => {
                const btn = document.createElement('button');
                // Styling button: Besar, Solid, Class warna dinamis
                btn.className = `answer-card w-full min-h-[140px] rounded-2xl text-white font-bold text-xl md:text-2xl p-6 shadow-lg border-b-8 ${colors[i]} flex items-center justify-center relative overflow-hidden`;
                btn.dataset.key = key;
                btn.onclick = () => check(key, btn);
                
                btn.innerHTML = `
                    <div class="absolute top-3 left-4 text-xs md:text-sm font-black bg-black/20 px-3 py-1 rounded-md">${key}</div>
                    <span class="drop-shadow-md leading-tight">${q.options[key]}</span>
                `;
                els.opts.appendChild(btn);
            });

            startTimer();
        }

        function startTimer() {
            clearInterval(state.interval);
            state.timer = 15;
            updateTimerDisplay();
            
            state.interval = setInterval(() => {
                state.timer--;
                updateTimerDisplay();
                if (state.timer <= 0) {
                    clearInterval(state.interval);
                    timeout();
                }
            }, 1000);
        }

        function updateTimerDisplay() {
            els.timer.textContent = state.timer;
            // Ubah warna jadi merah jika waktu habis
            if (state.timer <= 5) {
                els.timer.classList.replace('text-yellow-400', 'text-red-500');
                els.timer.parentElement.classList.replace('border-yellow-500', 'border-red-500');
            } else {
                els.timer.classList.replace('text-red-500', 'text-yellow-400');
                els.timer.parentElement.classList.replace('border-red-500', 'border-yellow-500');
            }
        }

        function check(ans, btn) {
            if (state.isAnswered) return;
            state.isAnswered = true;
            clearInterval(state.interval);

            const q = questions[state.idx];
            const correct = q.correct;

            if (ans === correct) {
                // --- JAWABAN BENAR ---
                handleCorrect(btn);
                state.score += 100; // Tambah Poin
                els.score.textContent = state.score;
            } else {
                // --- JAWABAN SALAH ---
                // Hapus warna asal
                btn.className = btn.className.replace(/bg-\[#.*?\]/g, '').replace(/border-\[#.*?\]/g, '');
                btn.classList.add('wrong-answer'); // Kasih merah
                
                // Cari yang benar dan kasih hijau
                document.querySelectorAll('.answer-card').forEach(b => {
                    if (b.dataset.key === correct) {
                        handleCorrect(b); // Panggil fungsi hijaukan
                    } else if (b !== btn) {
                        b.style.opacity = '0.4'; // Sisanya redup
                    }
                });
            }

            setTimeout(() => {
                state.idx++;
                loadQuestion();
            }, 2000);
        }

        function handleCorrect(btn) {
            // Hapus class warna solid bawaan (regex replace)
            btn.className = btn.className.replace(/bg-\[#.*?\]/g, '').replace(/border-\[#.*?\]/g, '');
            // Tambah class IJO TERANG
            btn.classList.add('correct-answer');
        }

        function timeout() {
            if (state.isAnswered) return;
            state.isAnswered = true;
            const q = questions[state.idx];
            
            document.querySelectorAll('.answer-card').forEach(b => {
                if (b.dataset.key === q.correct) {
                    handleCorrect(b);
                } else {
                    b.style.opacity = '0.4';
                }
            });
            
            setTimeout(() => {
                state.idx++;
                loadQuestion();
            }, 2000);
        }

        function useHelp(id) {
            if (state.helps[id] || state.isAnswered) return;
            
            const btn = document.getElementById(`help-${id}`);
            // Efek tombol terpakai
            btn.disabled = true;
            btn.classList.add('grayscale', 'opacity-50', 'cursor-not-allowed');
            state.helps[id] = true;

            if (id === 1) { 
                // 50:50 Logic
                const q = questions[state.idx];
                const wrongs = Object.keys(q.options).filter(k => k !== q.correct);
                const remove = wrongs.sort(() => 0.5 - Math.random()).slice(0, 2);
                document.querySelectorAll('.answer-card').forEach(b => {
                    if (remove.includes(b.dataset.key)) {
                        b.style.visibility = 'hidden';
                    }
                });
            } else if (id === 2) {
                // +10 Detik Logic
                state.timer += 10;
                updateTimerDisplay();
            } else if (id === 3) {
                // Shield (Contoh visual saja di sini)
                alert("Shield Aktif: Poin kamu aman jika salah kali ini!");
            }
        }

        function finish() {
            els.finalScore.textContent = state.score;
            els.modal.classList.remove('hidden');
        }

        function backToHome() {
            // Redirect ke halaman utama
            window.location.href = '/'; // Sesuaikan route Laravel
        }

        // Start
        init();
    </script>
</body>
</html>