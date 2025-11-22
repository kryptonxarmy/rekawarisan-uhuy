<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz App - Full Screen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            width: 100vw;
            height: 100vh;
            overflow-x: hidden;
        }
        
        .option-btn {
            transition: all 0.3s ease;
        }
        
        .option-btn:hover:not(:disabled) {
            transform: scale(1.05);
        }
        
        .shake {
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
        
        .pulse-success {
            animation: pulseSuccess 0.5s;
        }
        
        @keyframes pulseSuccess {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .help-btn {
            transition: all 0.3s ease;
        }

        .help-btn.used {
            opacity: 0.3;
            pointer-events: none;
        }

        .help-btn:not(.used):hover {
            transform: scale(1.1);
        }

        .help-btn.active {
            animation: pulse 1s infinite;
            box-shadow: 0 0 20px rgba(255, 255, 0, 0.6);
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.15); }
        }

        .fade-out {
            animation: fadeOut 0.5s forwards;
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: scale(0.8);
            }
        }

        .protection-indicator {
            animation: shield-pulse 2s infinite;
        }

        @keyframes shield-pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .second-chance-indicator {
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-900 via-purple-800 to-pink-900 min-h-screen">
    
    <div class="w-full min-h-screen px-4 py-6 md:px-8 md:py-8">
        <!-- Header -->
        <div class="max-w-7xl mx-auto flex items-center justify-between mb-8">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                    </svg>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="bg-purple-600 text-white px-6 py-3 rounded-full flex items-center gap-2 shadow-lg">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span id="score" class="font-bold text-xl">0</span>
                </div>
                <button class="bg-purple-500 text-white px-6 py-3 rounded-full font-semibold hover:bg-purple-600 transition-colors shadow-lg">
                    Bonus
                </button>
            </div>
        </div>

        <!-- Question Progress -->
        <div class="max-w-5xl mx-auto mb-8">
            <div class="bg-gray-900 bg-opacity-60 backdrop-blur-sm rounded-3xl p-8 shadow-2xl">
                <div class="text-center">
                    <div class="flex items-center justify-center gap-4 mb-6">
                        <span class="inline-block bg-black text-white px-6 py-3 rounded-full text-base font-semibold">
                            <span id="current-question">1</span>/<span id="total-questions">5</span>
                        </span>
                        <span id="timer" class="inline-block bg-red-600 text-white px-6 py-3 rounded-full text-base font-bold">
                            ⏱️ 15
                        </span>
                    </div>
                    <h2 id="question-text" class="text-3xl md:text-4xl font-bold text-white leading-relaxed">
                        Ciri dari UI yang baik adalah...
                    </h2>
                    <div id="protection-active" class="hidden mt-4 text-green-300 text-lg font-semibold flex items-center justify-center gap-2 protection-indicator">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"/>
                        </svg>
                        Perlindungan Aktif! Anda memiliki kesempatan kedua
                    </div>
                    <div id="second-chance-indicator" class="hidden mt-4 text-yellow-300 text-lg font-semibold flex items-center justify-center gap-2 second-chance-indicator">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Kesempatan Terakhir! (Tanpa perlindungan)
                    </div>
                </div>
            </div>
        </div>

        <!-- Answer Options Grid -->
        <div class="max-w-7xl mx-auto">
            <div id="options-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Options will be generated by JavaScript -->
            </div>

            <!-- Help Buttons -->
            <div class="flex justify-center gap-4 mb-6">
                <button id="help-1" onclick="useHelp(1)" class="help-btn w-16 h-16 rounded-full bg-green-500 hover:bg-green-600 shadow-xl flex items-center justify-center text-white font-bold text-2xl transform hover:shadow-2xl" title="Hilangkan 2 jawaban salah">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </button>
                <button id="help-2" onclick="useHelp(2)" class="help-btn w-16 h-16 rounded-full bg-yellow-500 hover:bg-yellow-600 shadow-xl flex items-center justify-center text-white font-bold text-2xl transform hover:shadow-2xl" title="Protection - Kesempatan kedua jika salah">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <button id="help-3" onclick="useHelp(3)" class="help-btn w-16 h-16 rounded-full bg-orange-500 hover:bg-orange-600 shadow-xl flex items-center justify-center text-white font-bold text-2xl transform hover:shadow-2xl" title="Tambah waktu +10 detik">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- User Info - Bottom Left -->
    <div class="fixed bottom-6 left-6 flex items-center gap-3 text-white bg-black bg-opacity-50 backdrop-blur-sm px-4 py-3 rounded-full shadow-xl">
        <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm">
            M
        </div>
        <span class="font-semibold text-base">Mohammad aden Ferangg...</span>
    </div>

    <!-- Results Modal -->
    <div id="results-modal" class="hidden fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-3xl shadow-2xl p-12 text-center max-w-md w-full">
            <div class="mb-6">
                <svg class="w-32 h-32 mx-auto text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Quiz Selesai!</h2>
            <p id="final-score" class="text-7xl font-bold text-purple-600 mb-4">0/5</p>
            <p class="text-gray-600 text-xl mb-8">Skor Anda</p>
            <button onclick="restartQuiz()" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-10 py-4 rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all w-full text-lg">
                Ulangi Quiz
            </button>
        </div>
    </div>

    <script>
        // Quiz Data
        const questions = [
            {
                question: "Ciri dari UI yang baik adalah...",
                options: {
                    A: "Banyak efek animasi",
                    B: "Warna mencolok dan kontras tinggi",
                    C: "Desain bersih dan navigasi mudah",
                    D: "Menggunakan font kecil"
                },
                correct: "C"
            },
            {
                question: "Apa kepanjangan dari CSS?",
                options: {
                    A: "Cascading Style Sheets",
                    B: "Computer Style Sheets",
                    C: "Creative Style System",
                    D: "Colorful Style Sheets"
                },
                correct: "A"
            },
            {
                question: "Framework JavaScript yang populer adalah?",
                options: {
                    A: "Python",
                    B: "React",
                    C: "MySQL",
                    D: "Photoshop"
                },
                correct: "B"
            },
            {
                question: "Warna primer dalam desain adalah?",
                options: {
                    A: "Orange, Pink, Ungu",
                    B: "Merah, Kuning, Biru",
                    C: "Hijau, Coklat, Abu",
                    D: "Putih, Hitam, Abu"
                },
                correct: "B"
            },
            {
                question: "Apa fungsi utama dari wireframe?",
                options: {
                    A: "Membuat website langsung jadi",
                    B: "Menentukan warna website",
                    C: "Merancang struktur dan layout",
                    D: "Menulis kode program"
                },
                correct: "C"
            }
        ];

        const colors = [
            'bg-gradient-to-br from-yellow-400 to-yellow-600',
            'bg-gradient-to-br from-purple-400 to-purple-600',
            'bg-gradient-to-br from-orange-400 to-orange-600',
            'bg-gradient-to-br from-cyan-400 to-cyan-600'
        ];

        let currentQuestionIndex = 0;
        let score = 0;
        let answeredCorrectly = false;
        let helpUsed = {1: false, 2: false, 3: false};
        let protectionActive = false;
        let hasSecondChance = false;
        let questionOrder = []; // Track question order
        let timeLeft = 15; // Timer in seconds
        let timerInterval = null;

        // Initialize quiz
        function initQuiz() {
            questionOrder = [...Array(questions.length).keys()]; // [0,1,2,3,4]
            document.getElementById('total-questions').textContent = questions.length;
            loadQuestion();
        }

        // Start timer
        function startTimer() {
            if (timerInterval) clearInterval(timerInterval);
            
            timerInterval = setInterval(() => {
                timeLeft--;
                updateTimerDisplay();
                
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timeOut();
                }
            }, 1000);
        }

        // Update timer display
        function updateTimerDisplay() {
            const timerEl = document.getElementById('timer');
            timerEl.textContent = `⏱️ ${timeLeft}`;
            
            // Change color based on time
            if (timeLeft <= 5) {
                timerEl.className = 'inline-block bg-red-600 text-white px-6 py-3 rounded-full text-base font-bold animate-pulse';
            } else if (timeLeft <= 10) {
                timerEl.className = 'inline-block bg-orange-600 text-white px-6 py-3 rounded-full text-base font-bold';
            } else {
                timerEl.className = 'inline-block bg-green-600 text-white px-6 py-3 rounded-full text-base font-bold';
            }
        }

        // Time out handler
        function timeOut() {
            if (answeredCorrectly) return;
            
            const allButtons = document.querySelectorAll('.option-btn');
            const questionIdx = questionOrder[currentQuestionIndex];
            const question = questions[questionIdx];
            
            // Show correct answer
            allButtons.forEach(btn => {
                btn.disabled = true;
                btn.style.opacity = '0.7';
                
                if (btn.dataset.option === question.correct) {
                    btn.classList.add('ring-4', 'ring-green-400');
                }
            });

            // Move to next question
            setTimeout(() => {
                currentQuestionIndex++;
                loadQuestion();
            }, 2000);
        }

        // Load current question
        function loadQuestion() {
            if (currentQuestionIndex >= questionOrder.length) {
                showResults();
                return;
            }

            // Reset timer
            timeLeft = 15;
            updateTimerDisplay();
            startTimer();

            const questionIdx = questionOrder[currentQuestionIndex];
            const question = questions[questionIdx];
            document.getElementById('question-text').textContent = question.question;
            document.getElementById('current-question').textContent = currentQuestionIndex + 1;
            
            // Reset indicators
            document.getElementById('protection-active').classList.add('hidden');
            document.getElementById('second-chance-indicator').classList.add('hidden');
            answeredCorrectly = false;
            hasSecondChance = false;

            // Show protection if active
            if (protectionActive) {
                document.getElementById('protection-active').classList.remove('hidden');
                document.getElementById('help-2').classList.add('active');
            } else {
                document.getElementById('help-2').classList.remove('active');
            }

            // Generate options
            const optionsContainer = document.getElementById('options-container');
            optionsContainer.innerHTML = '';

            const optionKeys = Object.keys(question.options);
            optionKeys.forEach((key, index) => {
                const button = document.createElement('button');
                button.className = `option-btn ${colors[index]} relative rounded-2xl p-8 h-64 flex items-center justify-center text-white font-bold text-xl text-center shadow-2xl`;
                button.dataset.option = key;
                button.onclick = () => selectAnswer(key, button);
                
                button.innerHTML = `
                    <span class="absolute top-4 right-4 bg-black bg-opacity-30 text-white w-10 h-10 rounded-full flex items-center justify-center text-base font-bold">
                        ${index + 1}
                    </span>
                    <span class="option-text px-4">
                        ${question.options[key]}
                    </span>
                `;
                
                optionsContainer.appendChild(button);
            });
        }

        // Use help/bantuan
        function useHelp(helpNumber) {
            if (helpUsed[helpNumber] || answeredCorrectly) return;

            helpUsed[helpNumber] = true;
            document.getElementById(`help-${helpNumber}`).classList.add('used');

            const questionIdx = questionOrder[currentQuestionIndex];
            const question = questions[questionIdx];
            const allButtons = document.querySelectorAll('.option-btn');
            
            if (helpNumber === 1) {
                // Hilangkan 2 jawaban salah
                const wrongOptions = Object.keys(question.options).filter(opt => opt !== question.correct);
                const toRemove = wrongOptions.sort(() => 0.5 - Math.random()).slice(0, 2);
                
                allButtons.forEach(btn => {
                    if (toRemove.includes(btn.dataset.option)) {
                        btn.classList.add('fade-out');
                        setTimeout(() => {
                            btn.style.visibility = 'hidden';
                        }, 500);
                    }
                });
            } else if (helpNumber === 2) {
                // Activate Protection Shield - gives second chance
                protectionActive = true;
                document.getElementById('protection-active').classList.remove('hidden');
                document.getElementById('help-2').classList.add('active');
            } else if (helpNumber === 3) {
                // Add 10 seconds to timer
                timeLeft += 10;
                updateTimerDisplay();
            }
        }

        // Handle answer selection
        function selectAnswer(option, button) {
            if (answeredCorrectly) return;

            const questionIdx = questionOrder[currentQuestionIndex];
            const question = questions[questionIdx];
            const isCorrect = option === question.correct;
            const allButtons = document.querySelectorAll('.option-btn');

            if (isCorrect) {
                // Correct answer - always +1 point
                button.classList.add('ring-4', 'ring-green-400', 'pulse-success');
                score += 1;
                document.getElementById('score').textContent = score.toFixed(1);
                answeredCorrectly = true;

                // Stop timer
                clearInterval(timerInterval);

                // Deactivate protection after successful answer
                if (protectionActive) {
                    protectionActive = false;
                }

                // Disable all buttons
                allButtons.forEach(btn => {
                    btn.disabled = true;
                    btn.style.opacity = '0.7';
                });

                // Next question after delay
                setTimeout(() => {
                    currentQuestionIndex++;
                    loadQuestion();
                }, 1500);

            } else {
                // Wrong answer
                
                // Check if protection is active
                if (protectionActive && !hasSecondChance) {
                    // First wrong with protection - give second chance
                    button.classList.add('ring-4', 'ring-yellow-400', 'shake', 'opacity-75');
                    button.disabled = true;
                    button.style.pointerEvents = 'none';
                    
                    hasSecondChance = true;
                    protectionActive = false; // Protection used up
                    document.getElementById('protection-active').classList.add('hidden');
                    document.getElementById('second-chance-indicator').classList.remove('hidden');

                    setTimeout(() => {
                        button.classList.remove('shake');
                    }, 500);
                    
                } else {
                    // No protection or second wrong - show correct and move on
                    button.classList.add('ring-4', 'ring-red-400', 'shake', 'opacity-75');
                    
                    // Stop timer
                    clearInterval(timerInterval);
                    
                    // Show correct answer
                    allButtons.forEach(btn => {
                        btn.disabled = true;
                        btn.style.opacity = '0.7';
                        
                        if (btn.dataset.option === question.correct) {
                            btn.classList.add('ring-4', 'ring-green-400');
                        }
                    });

                    // No points awarded
                    setTimeout(() => {
                        currentQuestionIndex++;
                        loadQuestion();
                    }, 2000);
                }
            }
        }

        // Show results
        function showResults() {
            clearInterval(timerInterval);
            const maxScore = questions.length;
            document.getElementById('final-score').textContent = `${score.toFixed(1)}/${maxScore}`;
            document.getElementById('results-modal').classList.remove('hidden');
        }

        // Restart quiz
        function restartQuiz() {
            clearInterval(timerInterval);
            currentQuestionIndex = 0;
            score = 0;
            protectionActive = false;
            hasSecondChance = false;
            timeLeft = 15;
            helpUsed = {1: false, 2: false, 3: false};
            
            document.getElementById('score').textContent = '0';
            document.getElementById('results-modal').classList.add('hidden');
            
            // Reset help buttons
            for (let i = 1; i <= 3; i++) {
                document.getElementById(`help-${i}`).classList.remove('used', 'active');
            }
            
            initQuiz();
        }

        // Start quiz on page load
        initQuiz();
    </script>
</body>
</html>