<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PhotoController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:foto.view', only: ['index']),
            new Middleware('permission:foto.create', only: ['create', 'store']),
            new Middleware('permission:foto.update', only: ['edit', 'update']),
            new Middleware('permission:foto.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $photos = Photo_model::latest()->paginate(10);
        return view('admin.dokumentasi.foto.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.dokumentasi.foto.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:255',
            'gambar'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
            'kategori'  => 'required|string|max:100',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('photos', 'public');
        }

        Photo_model::create($data);

        return redirect()
            ->route('admin.dokumentasi.foto.index')
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    public function edit(Photo_model $photo)
    {
        return view('admin.dokumentasi.foto.edit', compact('photo'));
    }

    public function update(Request $request, Photo_model $photo)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:255',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
            'kategori'  => 'required|string|max:100',
        ]);

        if ($request->hasFile('gambar')) {
            if ($photo->gambar) {
                Storage::disk('public')->delete($photo->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('photos', 'public');
        }

        $photo->update($data);

        return redirect()
            ->route('admin.dokumentasi.foto.index')
            ->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(Photo_model $photo)
    {
        if ($photo->gambar) {
            Storage::disk('public')->delete($photo->gambar);
        }

        $photo->delete();

        return redirect()
            ->route('admin.dokumentasi.foto.index')
            ->with('success', 'Foto berhasil dihapus.');
    }
}
