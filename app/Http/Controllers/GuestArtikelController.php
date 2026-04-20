<?php

namespace App\Http\Controllers;

use App\Models\artikel_model;
use App\Models\kategori_artikel_model;
use Illuminate\Http\Request;

class GuestArtikelController extends Controller
{
    /**
     * Halaman daftar artikel (publik)
     */
    public function index(Request $request)
    {
        $query = artikel_model::with(['kategori', 'penulis'])
                    ->published()
                    ->orderBy('published_at', 'desc');

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        // Search judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $articles = $query->paginate(9);

        // Kategori (langsung ambil, tanpa cache)
        $categories = kategori_artikel_model::orderBy('nama')->get();

        return view('guest.artikel.index', compact('articles', 'categories'));
    }

    /**
     * Halaman detail artikel (publik)
     */
    public function show($slug)
    {
        $article = artikel_model::with(['kategori', 'penulis'])
                    ->published()
                    ->where('slug', $slug)
                    ->firstOrFail();

        // Artikel terkait
        $relatedArticles = artikel_model::with('kategori')
                ->published()
                ->where('kategori_id', $article->kategori_id)
                ->where('id', '!=', $article->id)
                ->latest('published_at')
                ->take(3)
                ->get();

        // Artikel terbaru
        $latestArticles = artikel_model::with('kategori')
                ->published()
                ->latest('published_at')
                ->take(5)
                ->get();

        // Rekomendasi random
        $recommendedArticles = artikel_model::with('kategori')
                ->published()
                ->where('id', '!=', $article->id)
                ->inRandomOrder()
                ->take(5)
                ->get();

        return view('guest.artikel.show', compact(
            'article',
            'relatedArticles',
            'latestArticles',
            'recommendedArticles'
        ));
    }
}