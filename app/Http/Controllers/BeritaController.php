<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // Menampilkan daftar berita
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('berita.index', compact('beritas'));
    }

    // Menampilkan form tambah berita
    public function create()
    {
        return view('berita.create');
    }

    // Menyimpan berita baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'  => 'required|string|max:255',
            'isi'    => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/berita'), $nama);
            $validated['gambar'] = $nama;
        }

        Berita::create($validated);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    // Menampilkan form edit berita
    public function edit(Berita $berita)
    {
        return view('berita.edit', compact('berita'));
    }

    // Mengupdate berita
    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul'  => 'required|string|max:255',
            'isi'    => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar))) {
                unlink(public_path('uploads/berita/' . $berita->gambar));
            }

            $file = $request->file('gambar');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/berita'), $nama);
            $validated['gambar'] = $nama;
        }

        $berita->update($validated);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    // Menghapus berita
    public function destroy(Berita $berita)
    {
        if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar))) {
            unlink(public_path('uploads/berita/' . $berita->gambar));
        }

        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
