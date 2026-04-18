<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    // Halaman guest (dokumentasi foto)
    public function guestIndex()
    {
        $fotos = Photo::latest()->paginate(12);
        return view('guest.galeri.foto.index', compact('fotos'));
    }

    // ADMIN: daftar semua foto
    public function index()
    {
        $fotos = Photo::latest()->paginate(10);
        return view('admin.dokumentasi.foto.index', compact('fotos'));
    }

    // ADMIN: form tambah
    public function create()
    {
        return view('admin.dokumentasi.foto.create');
    }

    // ADMIN: simpan foto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('photos', 'public');
            $validated['gambar'] = $path;
        }

        Photo::create($validated);

        return redirect()->route('admin.dokumentasi.foto.index')
                         ->with('success', 'Foto berhasil ditambahkan.');
    }

    // ADMIN: form edit
    public function edit(Photo $foto)
    {
        return view('admin.dokumentasi.foto.edit', compact('foto'));
    }

    // ADMIN: update foto
    public function update(Request $request, Photo $foto)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($foto->gambar) {
                Storage::disk('public')->delete($foto->gambar);
            }
            $path = $request->file('gambar')->store('photos', 'public');
            $validated['gambar'] = $path;
        }

        $foto->update($validated);

        return redirect()->route('admin.dokumentasi.foto.index')
                         ->with('success', 'Foto berhasil diperbarui.');
    }

    // ADMIN: hapus foto
    public function destroy(Photo $foto)
    {
        if ($foto->gambar) {
            Storage::disk('public')->delete($foto->gambar);
        }
        $foto->delete();

        return redirect()->route('admin.dokumentasi.foto.index')
                         ->with('success', 'Foto berhasil dihapus.');
    }
}