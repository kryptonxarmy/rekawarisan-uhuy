<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all'); // all, unread, read, important
        
        // Dummy inbox messages
        $allMessages = collect([
            (object) [
                'id' => 1,
                'sender_name' => 'Ahmad Suryadi',
                'sender_email' => 'ahmad@example.com',
                'sender_avatar' => 'https://ui-avatars.com/api/?name=Ahmad+Suryadi&background=0F766E&color=fff',
                'subject' => 'Pertanyaan tentang artikel Batik Megamendung',
                'message' => 'Halo admin, saya ingin bertanya lebih detail tentang sejarah dan makna filosofis dari motif Batik Megamendung yang ada di artikel yang saya baca. Apakah ada sumber referensi lain yang bisa saya pelajari?',
                'type' => 'question', // question, suggestion, report, other
                'is_read' => false,
                'is_important' => true,
                'created_at' => now()->subMinutes(15),
                'category' => 'Artikel'
            ],
            (object) [
                'id' => 2,
                'sender_name' => 'Siti Nurhaliza',
                'sender_email' => 'siti@example.com',
                'sender_avatar' => 'https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=059669&color=fff',
                'subject' => 'Saran untuk misi harian',
                'message' => 'Selamat pagi, saya memiliki saran untuk variasi misi harian. Bagaimana kalau ditambahkan misi untuk menulis review artikel atau berbagi pengalaman tentang budaya daerah? Terima kasih.',
                'type' => 'suggestion',
                'is_read' => true,
                'is_important' => false,
                'created_at' => now()->subHours(2),
                'category' => 'Misi'
            ],
            (object) [
                'id' => 3,
                'sender_name' => 'Bambang Wijaya',
                'sender_email' => 'bambang@example.com',
                'sender_avatar' => 'https://ui-avatars.com/api/?name=Bambang+Wijaya&background=DC2626&color=fff',
                'subject' => 'Laporan bug pada halaman quiz',
                'message' => 'Admin, saya mengalami masalah saat mengerjakan quiz pada misi hari ini. Ketika saya klik jawaban, halaman tidak memberikan feedback. Browser yang saya gunakan adalah Chrome versi terbaru.',
                'type' => 'report',
                'is_read' => false,
                'is_important' => true,
                'created_at' => now()->subHours(4),
                'category' => 'Technical'
            ],
            (object) [
                'id' => 4,
                'sender_name' => 'Dewi Sartika',
                'sender_email' => 'dewi@example.com',
                'sender_avatar' => 'https://ui-avatars.com/api/?name=Dewi+Sartika&background=7C3AED&color=fff',
                'subject' => 'Permintaan konten artikel baru',
                'message' => 'Halo tim Rekawarisan, saya sangat menikmati artikel-artikel yang ada. Apakah ada rencana untuk menambahkan konten tentang kuliner tradisional dan resep-resep nenek moyang? Saya rasa banyak yang akan tertarik.',
                'type' => 'suggestion',
                'is_read' => true,
                'is_important' => false,
                'created_at' => now()->subDays(1),
                'category' => 'Konten'
            ],
            (object) [
                'id' => 5,
                'sender_name' => 'Andi Pratama',
                'sender_email' => 'andi@example.com',
                'sender_avatar' => 'https://ui-avatars.com/api/?name=Andi+Pratama&background=F59E0B&color=fff',
                'subject' => 'Apresiasi untuk platform Rekawarisan',
                'message' => 'Terima kasih sudah membuat platform yang luar biasa ini! Sebagai seorang guru, saya sering menggunakan konten dari Rekawarisan untuk mengajar siswa tentang budaya Indonesia. Keep up the good work!',
                'type' => 'other',
                'is_read' => false,
                'is_important' => false,
                'created_at' => now()->subDays(2),
                'category' => 'Feedback'
            ],
            (object) [
                'id' => 6,
                'sender_name' => 'Maya Indira',
                'sender_email' => 'maya@example.com',
                'sender_avatar' => 'https://ui-avatars.com/api/?name=Maya+Indira&background=10B981&color=fff',
                'subject' => 'Kolaborasi dengan museum daerah',
                'message' => 'Saya bekerja di Museum Sejarah Jakarta dan tertarik untuk berkolaborasi dengan platform Rekawarisan. Apakah ada kemungkinan untuk partnership dalam hal konten atau program edukasi?',
                'type' => 'other',
                'is_read' => true,
                'is_important' => true,
                'created_at' => now()->subDays(3),
                'category' => 'Partnership'
            ],
        ]);

        // Apply filters
        $messages = $allMessages;
        
        if ($filter === 'unread') {
            $messages = $messages->where('is_read', false);
        } elseif ($filter === 'read') {
            $messages = $messages->where('is_read', true);
        } elseif ($filter === 'important') {
            $messages = $messages->where('is_important', true);
        }

        // Statistics
        $stats = (object) [
            'total' => $allMessages->count(),
            'unread' => $allMessages->where('is_read', false)->count(),
            'important' => $allMessages->where('is_important', true)->count(),
        ];

        return view('admin.inbox.index', compact('messages', 'stats', 'filter'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // TODO: Show specific message
        return view('admin.inbox.show');
    }

    /**
     * Mark message as read
     */
    public function markAsRead(string $id)
    {
        // TODO: Mark message as read logic
        
        return redirect()->route('admin.inbox.index')
            ->with('success', 'Pesan berhasil ditandai sebagai dibaca');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // TODO: Delete message logic
        
        return redirect()->route('admin.inbox.index')
            ->with('success', 'Pesan berhasil dihapus');
    }
}
