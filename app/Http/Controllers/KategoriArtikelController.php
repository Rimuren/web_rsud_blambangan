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
            new Middleware('permission:view daftar-kategori', only: ['index']),
            new Middleware('permission:create kategori', only: ['create', 'store']),
            new Middleware('permission:edit kategori', only: ['edit', 'update']),
            new Middleware('permission:delete kategori', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // BUSINESS LOGIC: ambil semua kategori artikel diurutkan berdasarkan nama
        $kategori = kategori_artikel_model::orderBy('nama')->get();
        return view('admin.artikel.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // RETURN VIEW FOR CREATING KATEGORI
        return view('admin.artikel.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // VALIDATION LOGIC
        $validated = $request->validate([
            'nama' => 'required|max:100|unique:kategori_artikel,nama',
            'deskripsi' => 'nullable|string',
        ]);

        // SLUG GENERATION WITH UNIQUENESS CHECK
        $slug = Str::slug($validated['nama']);
        $originalSlug = $slug;
        $count = 1;
        while (kategori_artikel_model::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // CREATE NEW KATEGORI
        kategori_artikel_model::create([
            'nama' => $validated['nama'],
            'slug' => $slug,
            'deskripsi' => $validated['deskripsi'] ?? null,
        ]);

        return redirect()->route('admin.artikel.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // AUTHORIZATION AND DATA RETRIEVAL
        $kategori = kategori_artikel_model::findOrFail($id);
        return view('admin.artikel.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // AUTHORIZATION CHECK: find kategori or fail
        $kategori = kategori_artikel_model::findOrFail($id);

        // VALIDATION LOGIC WITH UNIQUE IGNORE CURRENT ID
        $validated = $request->validate([
            'nama' => ['required', 'max:100', Rule::unique('kategori_artikel', 'nama')->ignore($id)],
            'deskripsi' => 'nullable|string',
        ]);

        // SLUG HANDLING: regenerate if name changed and ensure uniqueness
        $slug = Str::slug($validated['nama']);
        if ($slug !== $kategori->slug) {
            $originalSlug = $slug;
            $count = 1;
            while (kategori_artikel_model::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
        }

        // UPDATE KATEGORI
        $kategori->update([
            'nama' => $validated['nama'],
            'slug' => $slug,
            'deskripsi' => $validated['deskripsi'] ?? null,
        ]);

        return redirect()->route('admin.artikel.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // AUTHORIZATION AND DELETE LOGIC
        $kategori = kategori_artikel_model::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.artikel.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
