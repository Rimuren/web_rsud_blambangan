<?php

namespace App\Http\Controllers;

use App\Models\artikel_model;
use App\Models\kategori_artikel_model;
use Illuminate\Http\Request;

class GuestArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = artikel_model::with(['kategori', 'penulis'])->where('status', 'published')
            ->orderBy('published_at', 'desc');

        if ($request->filled('kategori')) {
            $query->whereHas('kategori', fn($q) => $q->where('slug', $request->kategori));
        }
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $artikels = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $kategoris = kategori_artikel_model::orderBy('nama')->get();

        return view('admin.artikel.index', compact('artikels', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $artikel = artikel_model::with(['kategori', 'penulis'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Artikel terkait (kategori sama, exclude artikel ini)
        $related = artikel_model::with('kategori')
            ->where('kategori_id', $artikel->kategori_id)
            ->where('id', '!=', $artikel->id)
            ->where('status', 'published')
            ->limit(3)
            ->get();

        // Berita terbaru (3 artikel terbaru selain artikel ini)
        $latestNews = artikel_model::with('kategori')
            ->where('status', 'published')
            ->where('id', '!=', $artikel->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Topik populer (kategori dengan jumlah artikel terbanyak)
        $trendingCategories = kategori_artikel_model::withCount('artikel')
            ->orderBy('artikel_count', 'desc')
            ->limit(6)
            ->get();

        return view('guest.artikel.detail', compact('artikel', 'related', 'latestNews', 'trendingCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
