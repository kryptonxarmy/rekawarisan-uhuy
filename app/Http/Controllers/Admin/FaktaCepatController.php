<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaktaCepat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FaktaCepatController extends Controller
{
    // Tampilkan daftar fakta cepat
    public function index()
    {
        $faktaCepats = FaktaCepat::latest()->get();
        return view('admin.fakta-cepat.index', compact('faktaCepats'));
    }

    // Tampilkan form tambah fakta cepat
    public function create()
    {
        return view('admin.fakta-cepat.create');
    }

    // Simpan fakta cepat baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'pencipta' => 'required|string|max:255',
            'periode' => 'required|string|max:255',
            'status_unesco' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'penampilan' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'nama' => $validated['nama'],
            'asal' => $validated['asal'],
            'pencipta' => $validated['pencipta'],
            'periode' => $validated['periode'],
            'status_unesco' => $validated['status_unesco'],
            'kategori' => $validated['kategori'],
            'penampilan' => $validated['penampilan'],
            'author_id' => auth()->id(),
            'author_type' => 'admin',
            'is_verified' => true,
            'status' => 'approved',
        ];

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('fakta-cepat', 'public');
            $data['img_url'] = Storage::url($path);
        }

        FaktaCepat::create($data);

        return redirect()->route('admin.fakta-cepat.index')
            ->with('success', 'Fakta Cepat berhasil ditambahkan');
    }

    // Tampilkan detail fakta cepat
    public function show(FaktaCepat $faktaCepat)
    {
        return view('admin.fakta-cepat.show', compact('faktaCepat'));
    }

    // Tampilkan form edit fakta cepat
    public function edit(FaktaCepat $faktaCepat)
    {
        return view('admin.fakta-cepat.edit', compact('faktaCepat'));
    }

    // Update fakta cepat
    public function update(Request $request, FaktaCepat $faktaCepat)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'pencipta' => 'required|string|max:255',
            'periode' => 'required|string|max:255',
            'status_unesco' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'penampilan' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'nama' => $validated['nama'],
            'asal' => $validated['asal'],
            'pencipta' => $validated['pencipta'],
            'periode' => $validated['periode'],
            'status_unesco' => $validated['status_unesco'],
            'kategori' => $validated['kategori'],
            'penampilan' => $validated['penampilan'],
        ];

        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama jika ada dan img_url mengarah ke storage
            if ($faktaCepat->img_url && str_contains($faktaCepat->img_url, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $faktaCepat->img_url);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('thumbnail')->store('fakta-cepat', 'public');
            $data['img_url'] = Storage::url($path);
        }

        $faktaCepat->update($data);

        return redirect()->route('admin.fakta-cepat.index')
            ->with('success', 'Fakta Cepat berhasil diperbarui');
    }

    // Hapus fakta cepat
    public function destroy(FaktaCepat $faktaCepat)
    {
        if ($faktaCepat->img_url && str_contains($faktaCepat->img_url, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $faktaCepat->img_url);
            Storage::disk('public')->delete($oldPath);
        }
        $faktaCepat->delete();
        return redirect()->route('admin.fakta-cepat.index')
            ->with('success', 'Fakta Cepat berhasil dihapus');
    }

    // Approve fakta cepat
    public function approve(FaktaCepat $faktaCepat)
    {
        $faktaCepat->update([
            'status' => 'approved',
            'is_verified' => true
        ]);

        return redirect()->back()->with('success', 'Fakta Cepat berhasil disetujui');
    }

    // Reject fakta cepat
    public function reject(FaktaCepat $faktaCepat)
    {
        $faktaCepat->update([
            'status' => 'rejected',
            'is_verified' => false
        ]);

        return redirect()->back()->with('success', 'Fakta Cepat berhasil ditolak');
    }
}
