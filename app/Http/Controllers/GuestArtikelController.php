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

        // Kategori 
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

    // === INCREMENT VIEWS (hanya sekali per session) ===
    $sessionKey = 'viewed_article_' . $article->id;
    if (!session()->has($sessionKey)) {
        $article->increment('views');
        session()->put($sessionKey, true);
    }

    // === REKOMENDASI (Hybrid: kategori sama → views terbanyak → terbaru) ===
    // Prioritas 1: Artikel dengan kategori yang sama
    $recommendedArticles = artikel_model::with('kategori')
        ->published()
        ->where('kategori_id', $article->kategori_id)
        ->where('id', '!=', $article->id)
        ->orderBy('views', 'desc')
        ->orderBy('published_at', 'desc')
        ->take(5)
        ->get();

    // Jika kurang dari 5, ambil artikel populer (views terbanyak) dari kategori lain
    if ($recommendedArticles->count() < 5) {
        $needed = 5 - $recommendedArticles->count();
        $excludeIds = $recommendedArticles->pluck('id')->push($article->id);
        $popular = artikel_model::published()
            ->whereNotIn('id', $excludeIds)
            ->orderBy('views', 'desc')
            ->orderBy('published_at', 'desc')
            ->take($needed)
            ->get();
        $recommendedArticles = $recommendedArticles->concat($popular);
    }

    // Jika masih kurang (misal total artikel sedikit), tambahkan artikel terbaru
    if ($recommendedArticles->count() < 5) {
        $needed = 5 - $recommendedArticles->count();
        $excludeIds = $recommendedArticles->pluck('id')->push($article->id);
        $latest = artikel_model::published()
            ->whereNotIn('id', $excludeIds)
            ->orderBy('published_at', 'desc')
            ->take($needed)
            ->get();
        $recommendedArticles = $recommendedArticles->concat($latest);
    }

    // === ARTIKEL TERKAIT (tetap berdasarkan kategori) ===
    $relatedArticles = artikel_model::with('kategori')
        ->published()
        ->where('kategori_id', $article->kategori_id)
        ->where('id', '!=', $article->id)
        ->latest('published_at')
        ->take(3)
        ->get();

    // === ARTIKEL TERBARU (sidebar) ===
    $latestArticles = artikel_model::with('kategori')
        ->published()
        ->latest('published_at')
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