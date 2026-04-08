<?php

namespace App\Http\Controllers;

use App\Models\kategori_artikel_model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class KategoriArtikelController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view kategori', only: ['index']),
            new Middleware('permission:create kategori', only: ['create', 'store']),
            new Middleware('permission:edit kategori', only: ['edit', 'update']),
            new Middleware('permission:delete kategori', only: ['destroy']),
        ];
    }

    public function index()
    {
        $kategori = kategori_artikel_model::orderBy('nama')->get();
        return view('admin.artikel.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.artikel.kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100|unique:kategori_artikel,nama',
            'deskripsi' => 'nullable|string',
        ]);

        $slug = Str::slug($validated['nama']);
        $originalSlug = $slug;
        $count = 1;
        while (kategori_artikel_model::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        kategori_artikel_model::create([
            'nama' => $validated['nama'],
            'slug' => $slug,
            'deskripsi' => $validated['deskripsi'] ?? null,
        ]);

        return redirect()->route('admin.artikel.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = kategori_artikel_model::findOrFail($id);
        return view('admin.artikel.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = kategori_artikel_model::findOrFail($id);

        $validated = $request->validate([
            'nama' => ['required', 'max:100', Rule::unique('kategori_artikel', 'nama')->ignore($id)],
            'deskripsi' => 'nullable|string',
        ]);

        $slug = Str::slug($validated['nama']);
        // Jika slug berubah dan sudah ada, buat unik
        if ($slug !== $kategori->slug) {
            $originalSlug = $slug;
            $count = 1;
            while (kategori_artikel_model::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
        }

        $kategori->update([
            'nama' => $validated['nama'],
            'slug' => $slug,
            'deskripsi' => $validated['deskripsi'] ?? null,
        ]);

        return redirect()->route('admin.artikel.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = kategori_artikel_model::findOrFail($id);

        $kategori->delete();
        return redirect()->route('admin.artikel.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
