<?php

namespace App\Http\Controllers;

use App\Models\artikel_model;
use App\Models\kategori_artikel_model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view daftar-artikel', only: ['index']),
            new Middleware('permission:create artikel', only: ['create', 'store']), 
            new Middleware('permission:edit artikel', only: ['edit', 'update']),
            new Middleware('permission:delete artikel', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $query = artikel_model::with(['kategori', 'penulis']);

        if ($request->filled('kategori')) {
            $query->whereHas('kategori', fn($q) => $q->where('slug', $request->kategori));
        }
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $artikels = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $kategoris = kategori_artikel_model::orderBy('nama')->get();

        return view('admin.artikel.index', compact('artikels', 'kategoris'));
    }

    public function create()
    {
        $kategoris = kategori_artikel_model::orderBy('nama')->get();
        return view('admin.artikel.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'kategori_id' => 'required|exists:kategori_artikel,id',
            'konten' => 'required|string',
            'thumbnail' => 'nullable|image|max:5120',
            'status' => 'in:draft,published',
        ]);

        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori_id' => $request->kategori_id,
            'penulis_id' => Auth::id(),
            'status' => $request->status,
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('artikel-thumbnails', 'public');
        }

        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        artikel_model::create($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil disimpan.');
    }

    public function edit($id)
    {
        $artikel = artikel_model::findOrFail($id);
        $kategoris = kategori_artikel_model::orderBy('nama')->get();
        return view('admin.artikel.edit', compact('artikel', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $artikel = artikel_model::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:200',
            'kategori_id' => 'required|exists:kategori_artikel,id',
            'konten' => 'required|string',
            'thumbnail' => 'nullable|image|max:5120',
            'status' => 'in:draft,published',
        ]);

        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori_id' => $request->kategori_id,
            'status' => $request->status,
        ];

        if ($request->hasFile('thumbnail')) {
            if ($artikel->thumbnail && Storage::disk('public')->exists($artikel->thumbnail)) {
                Storage::disk('public')->delete($artikel->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('artikel-thumbnails', 'public');
        }

        if ($request->status === 'published' && $artikel->status !== 'published') {
            $data['published_at'] = now();
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $artikel = artikel_model::findOrFail($id);
        if ($artikel->thumbnail && Storage::disk('public')->exists($artikel->thumbnail)) {
            Storage::disk('public')->delete($artikel->thumbnail);
        }
        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate(['image' => 'required|image|max:5120']);
        $path = $request->file('image')->store('artikel-images', 'public');
        return response()->json(['url' => Storage::url($path)]);
    }
}
