<?php

namespace App\Http\Controllers;

use App\Models\faktaCepat;
use Illuminate\Http\Request;

class FaktaCepatController extends Controller
{
    public function create()
    {
        return view('frontend.pustakawarisan.create'); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'pencipta' => 'nullable|string|max:255',
            'periode' => 'nullable|string|max:255',
            'status_unesco' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'penampilan' => 'nullable|string',
        ]);

        FaktaCepat::create($validated);

        return redirect()->route('frontend.pustakawarisan.create')->with('success', 'Fakta Cepat berhasil dibuat!');
    }
}
