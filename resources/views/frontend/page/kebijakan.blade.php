@extends('frontend.layout.app', ['title' => 'Kebijakan'])

@section('content')
<!-- content for Kebijakan page goes here -->
 <div class="bg-gray-50 min-h-screen">
    
      <!-- hero section -->
    <div class="min-h-[30vh] xl:min-h-[25vh] 2xl:min-h-[15vh] flex flex-col px-6 pt-20 **mt-[-5rem]**" style="background-image: url('{{ asset('assets/landing/background-herosection.png') }}'); background-size: cover; background-repeat: no-repeat; background-position: center; ">
        <div class="container mt-5 p-4 relative z-10">
            
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-3">
                Kebijakan Privasi
            </h1>

            <div class="text-sm font-semibold text-white/80">
                <a href="{{ route('beranda') }}" class="hover:underline text-yellow-300">Home</a>
                <span class="mx-2">&gt;</span>
                <span>Kebijakan Privasi</span>
            </div>
            
        </div>
    </div>
    <!-- end -->

    <main class="container mx-auto my-4 px-6 py-12 max-w-4xl bg-white shadow-xl md:rounded-lg mt-8 relative">
        
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">
            Kebijakan Privasi Reka Warisan
        </h1>

        <div class="space-y-8 text-gray-700">

            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-2">1. Pendahuluan</h2>
                <p>Selamat Datang di Reka Warisan. Kami berkomitmen untuk menjaga privasi dan keamanan informasi pribadi Anda saat menggunakan platform ini untuk belajar, memahami, dan berkontribusi dalam pelestarian budaya Indonesia.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-3">2. Informasi yang kami kumpulkan</h2>
                <p class="mb-2">Kami dapat mengumpulkan data pribadi seperti:</p>
                <ul class="list-disc ml-5 space-y-1">
                    <li>Nama lengkap</li>
                    <li>Alamat email</li>
                    <li>Aktivitas di platform (artikel yang dibaca, kuis yang diikuti, poin, dan badge yang diperoleh)</li>
                    <li>Konten budaya yang Anda unggah atau tulis</li>
                </ul>
            </section>

            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-3">3. Penggunaan Informasi</h2>
                <p>Data yang kami kumpulkan digunakan untuk:</p>
                <ul class="list-disc ml-5 space-y-1">
                    <li>Menyediakan akses ke fitur pembelajaran dan publikasi artikel budaya</li>
                    <li>Mengelola akun pengguna dan progres aktivitas</li>
                    <li>Mengirimkan notifikasi, pembaruan, dan penghargaan (poin atau badge)</li>
                    <li>Menyempurnakan pengalaman pengguna di platform</li>
                </ul>
            </section>

            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-2">4. Berbagi Informasi</h2>
                <p>Kami tidak menjual atau membagikan data pribadi kepada pihak ketiga tanpa izin Anda, kecuali jika diwajibkan oleh hukum.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-2">5. Keamanan Data</h2>
                <p>Reka Warisan menggunakan langkah-langkah teknis dan administratif untuk melindungi data Anda dari akses tidak sah, kehilangan, atau penyalahgunaan. Kami terus memperbarui sistem keamanan agar tetap sesuai dengan standar terbaik.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-3">6. Hak Pengguna</h2>
                <p>Anda memiliki hak untuk:</p>
                <ul class="list-disc ml-5 space-y-1">
                    <li>Mengakses, memperbarui, atau menghapus data pribadi Anda</li>
                    <li>Meminta penghapusan akun Reka Warisan beserta seluruh datanya</li>
                    <li>Menolak menerima komunikasi promosi atau pembaruan melalui email</li>
                </ul>
            </section>
            
            <section>
                <h2 class="text-xl font-bold text-gray-900 mb-2">7. Perubahan Kebijakan</h2>
                <p>Kebijakan privasi ini dapat diperbarui dari waktu ke waktu untuk menyesuaikan dengan pengembangan layanan Reka Warisan. Setiap perubahan akan diumumkan melalui situs resmi kami.</p>
            </section>

        </div>
    </main>
</div>

@endsection