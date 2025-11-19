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
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">Tari saman - Budaya Suku Gayo Aceh</h1>
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                        <span>Kategori: <span class="text-teal-600 font-semibold">Tarian</span></span>
                        <span>Provinsi: <span class="text-teal-600 font-semibold">Aceh</span></span>
                        <span>Ditulis Oleh: <span class="text-teal-600 font-semibold">Admin Reka Warisan</span></span>
                        <span class="flex items-center">👁️ 10,263 Dilihat</span>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="mb-8">
                    <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full rounded-lg shadow-md">
                </div>

                <!-- Content -->
                <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                    <div class="prose max-w-none">
                        <p class="text-gray-700 mb-6">
                            <strong>Tari Saman</strong> adalah tarian tradisional yang berasal dari Suku Gayo di Aceh, Indonesia. Tarian ini dikenal sebagai salah satu warisan budaya yang paling menakjubkan karena memadukan gerakan cepat, harmoni vokal, dan energi yang luar biasa. Tari Saman biasanya dibawakan oleh sekelompok penari laki-laki yang duduk berbaris dengan seragam tradisional Aceh, melakukan gerakan tangan yang rumit bersama tepuk tangan yang dikoordinasi dengan sempurna. Tarian ini bukan hanya tentang estetika fisik, tetapi juga membawa pesan moral dan keagamaan yang selaras dengan gerakan dan syair-syair yang ditampilkan.
                        </p>

                        <div class="bg-teal-50 border-l-4 border-teal-600 p-4 mb-6">
                            <p class="text-teal-900 italic">"Memuat sebagai Tarian Serbu Tangan"</p>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Sejarah dan Makna</h2>
                        <p class="text-gray-700 mb-6">
                            Tari Saman didasarkan pada legenda Islami. Berawal dari masa Nabi Umar dan daya yang berkembang dari pemikiran tradisional Islam dalam masyarakat Aceh. Tarian ini dirancang untuk merayakan berbagai peristiwa penting, seperti kelahiran nabi Muhammad SAW, pernikahan tradisional, atau peristiwa-peristiwa lain yang relevan dengan kehidupan sosial dan religi masyarakat Gayo. Tari Saman tidak hanya dimaksudkan sebagai hiburan, tetapi juga sebagai bentuk dakwah atau penyampaian pesan Islam melalui gerakan dan lirik yang harmonis.
                        </p>
                        <p class="text-gray-700 mb-6">
                            Pada tahun 2011, UNESCO menetapkan Tari Saman sebagai Warisan Budaya Takbenda yang Memerlukan Perlindungan Mendesak (List of Intangible Cultural Heritage in Need of Urgent Safeguarding).
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Karakteristik Tarian</h2>
                        <ul class="list-none space-y-3 mb-6">
                            <li class="flex items-start">
                                <span class="text-teal-600 mr-2">●</span>
                                <span class="text-gray-700">Gerakan tangan yang cepat dan sinkronisasi</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-teal-600 mr-2">●</span>
                                <span class="text-gray-700">Tepukan tangan yang menjadi iringan musik</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-teal-600 mr-2">●</span>
                                <span class="text-gray-700">Syair dalam bahasa Gayo yang mengandung pesan moral</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-teal-600 mr-2">●</span>
                                <span class="text-gray-700">Kostum tradisional seragam yang menjadi ciri khas penari</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-teal-600 mr-2">●</span>
                                <span class="text-gray-700">Formasi duduk berbaris yang rapat</span>
                            </li>
                        </ul>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Kostum Tradisional</h2>
                        <p class="text-gray-700 mb-6">
                            Penari Tari Saman mengenakan pakaian adat Aceh yang kental dari baju hitam dengan hiasan benang emas, warna di bagian dada dan lengan. Mereka juga mengenakan kain songket di bagian pinggang yang dikenakan dengan sangat anggun. Kostum ini mencerminkan identitas khas Suku Gayo sekaligus menampilkan kemegahan budaya Aceh. Para penari memakai kain saluang yang dihibur di sekitar kepala atau kepala yang dihias "sarapet", yang adalah simbol penghormatan terhadap adat Aceh tradisional sebagai motif khas Aceh.
                        </p>
                    </div>

                    <!-- Social Actions -->
                    <div class="flex items-center gap-4 mt-8 pt-6 border-t">
                        <button class="flex items-center gap-2 text-gray-600 hover:text-teal-600">
                            <span>❤️</span>
                            <span>Sukai</span>
                        </button>
                        <button class="flex items-center gap-2 text-gray-600 hover:text-teal-600">
                            <span>↗️</span>
                            <span>Komentar</span>
                        </button>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Komentar</h3>
                        <button class="text-teal-600 hover:text-teal-700 font-semibold">+ Tambahkan Komentar</button>
                    </div>

                    <!-- Comment Item -->
                    <div class="space-y-6">
                        <div class="border-b pb-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"></div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-bold text-gray-900">Rina Safitri</span>
                                        <span class="text-gray-500 text-sm">7 hari yang lalu</span>
                                    </div>
                                    <p class="text-gray-700 mb-2">Tari Saman sangat memukau! Saya jadi lebih besar lagi dengan kesenian Aceh dan bawaan luar biasa, termasuk yang karyanya ada model yang terdampat dengan tradisinya!</p>
                                    <button class="text-teal-600 hover:text-teal-700 text-sm">❤️ 11</button>
                                </div>
                            </div>
                        </div>

                        <div class="border-b pb-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"></div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-bold text-gray-900">Ahmad Rizki</span>
                                        <span class="text-gray-500 text-sm">2 hari yang lalu</span>
                                    </div>
                                    <p class="text-gray-700 mb-2">Warisan budaya yang harus kita lestarikan. Tarian Kami tradisi terbaik daramaah Indonesia termasuk tari Saman ini.</p>
                                    <button class="text-teal-600 hover:text-teal-700 text-sm">❤️ 8</button>
                                </div>
                            </div>
                        </div>

                        <div class="border-b pb-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"></div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-bold text-gray-900">Siti Nurhaliza</span>
                                        <span class="text-gray-500 text-sm">5 hari yang lalu</span>
                                    </div>
                                    <p class="text-gray-700 mb-2">Sangat bangga dengan budaya Aceh! Tari Saman adalah salah satu tarian tradisional yang paling terkenal di Indonesia.</p>
                                    <button class="text-teal-600 hover:text-teal-700 text-sm">❤️ 14</button>
                                </div>
                            </div>
                        </div>

                        <div class="pb-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"></div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-bold text-gray-900">Budi Santoso</span>
                                        <span class="text-gray-500 text-sm">3 hari yang lalu</span>
                                    </div>
                                    <p class="text-gray-700 mb-2">Artikel yang sangat informatif! Semakin lebih memahami sejarah dan makna di balik Tari Saman.</p>
                                    <button class="text-teal-600 hover:text-teal-700 text-sm">❤️ 9</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Articles -->
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Artikel Budaya Terkait</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="relative h-32">
                                <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                                <span class="absolute top-2 left-2 bg-yellow-400 text-yellow-900 px-2 py-1 rounded-full text-xs font-semibold">Tarian</span>
                            </div>
                            <div class="p-3">
                                <h4 class="font-bold text-gray-800 text-sm mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                                <p class="text-gray-600 text-xs mb-3">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                                <button class="text-teal-600 text-xs font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                            </div>
                        </a>
                        <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="relative h-32">
                                <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                                <span class="absolute top-2 left-2 bg-yellow-400 text-yellow-900 px-2 py-1 rounded-full text-xs font-semibold">Tarian</span>
                            </div>
                            <div class="p-3">
                                <h4 class="font-bold text-gray-800 text-sm mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                                <p class="text-gray-600 text-xs mb-3">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                                <button class="text-teal-600 text-xs font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                            </div>
                        </a>
                        <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="relative h-32">
                                <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                                <span class="absolute top-2 left-2 bg-yellow-400 text-yellow-900 px-2 py-1 rounded-full text-xs font-semibold">Tarian</span>
                            </div>
                            <div class="p-3">
                                <h4 class="font-bold text-gray-800 text-sm mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                                <p class="text-gray-600 text-xs mb-3">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                                <button class="text-teal-600 text-xs font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                            </div>
                        </a>
                        <a href="/detail" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="relative h-32">
                                <img src="{{ asset('images/tari_saman.jpeg') }}" alt="Tari Saman" class="w-full h-full object-cover">
                                <span class="absolute top-2 left-2 bg-yellow-400 text-yellow-900 px-2 py-1 rounded-full text-xs font-semibold">Tarian</span>
                            </div>
                            <div class="p-3">
                                <h4 class="font-bold text-gray-800 text-sm mb-2">TARI SAMAN - BUDAYA SUKU GAYO ACEH</h4>
                                <p class="text-gray-600 text-xs mb-3">Tari Saman berasal dari daratan Tinggi Gayo di Aceh dan telah diakui oleh UNESCO sebagai Warisan Budaya Takbenda.</p>
                                <button class="text-teal-600 text-xs font-semibold hover:text-teal-700">Baca Selengkapnya</button>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-teal-700 text-white rounded-lg shadow-lg p-6 sticky top-4">
                    <h3 class="text-2xl font-bold mb-6">Fakta Cepat</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-bold mb-2">Tari Saman</h4>
                            <p class="text-sm text-teal-50">Tarian</p>
                        </div>

                        <div>
                            <h4 class="font-bold mb-2">Budaya Gayo, Aceh</h4>
                            <p class="text-sm text-teal-50">Asal</p>
                        </div>

                        <div>
                            <h4 class="font-bold mb-2">Syeikh Saman</h4>
                            <p class="text-sm text-teal-50">Pencetus</p>
                        </div>

                        <div>
                            <h4 class="font-bold mb-2">Abad ke-14</h4>
                            <p class="text-sm text-teal-50">Periode</p>
                        </div>

                        <div>
                            <h4 class="font-bold mb-2">Status UNESCO: 2011 (Warisan Budaya Takbenda yang Memerlukan Perlindungan Mendesak)</h4>
                            <p class="text-sm text-teal-50">Pengakuan Internasional</p>
                        </div>

                        <div>
                            <h4 class="font-bold mb-2">Keseniman dan Tarian</h4>
                            <p class="text-sm text-teal-50">Kategori</p>
                        </div>

                        <div>
                            <h4 class="font-bold mb-2">Acara adat, perayaan</h4>
                            <p class="text-sm text-teal-50">Penggunaan</p>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-teal-600">
                        <button class="w-full bg-white text-teal-700 py-3 rounded-lg font-bold hover:bg-teal-50 transition-colors">
                            Lihat Tata Website
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
