<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
public function index()
{
    // Ambil semua kontak tanpa orderBy created_at
    $contacts = Contact::get();

    return view('admin.inbox.index', compact('contacts'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'message' => 'required|string',
    ]);

    // Simpan ke database
    Contact::create($validated);

    return redirect()->back()->with('success', 'Terima kasih sudah mengirimkan pesan Anda.');
}

}
