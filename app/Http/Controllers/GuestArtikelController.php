<?php

namespace App\Http\Controllers;

use App\Models\artikel_model;
use App\Models\kategori_artikel_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GuestArtikelController extends Controller
{
    /**
     * Halaman daftar artikel (publik)
     */
    public function index(Request $request)
    {
        // Buat cache key unik berdasarkan parameter request
        $cacheKey = 'guest_articles_' . md5(json_encode($request->only(['kategori', 'search', 'page'])));

        $data = Cache::remember($cacheKey, now()->addHours(1), function () use ($request) {
            $query = artikel_model::with(['kategori', 'penulis'])
                        ->published()
                        ->orderBy('published_at', 'desc');

            // Filter berdasarkan kategori (slug)
            if ($request->filled('kategori')) {
                $query->whereHas('kategori', function ($q) use ($request) {
                    $q->where('slug', $request->kategori);
                });
            }

            // Pencarian berdasarkan judul
            if ($request->filled('search')) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            }

            $articles = $query->paginate(9);

            // Ambil semua kategori untuk filter (jarang berubah, cache terpisah)
            $categories = Cache::remember('guest_categories_all', now()->addDay(), function () {
                return kategori_artikel_model::orderBy('nama')->get();
            });

            return [
                'articles' => $articles,
                'categories' => $categories,
            ];
        });

        return view('guest.artikel.index', [
            'articles' => $data['articles'],
            'categories' => $data['categories'],
        ]);
    }

    /**
     * Halaman detail artikel (publik)
     */
    public function show($slug)
    {
        $cacheKey = "guest_article_{$slug}";

        $article = Cache::remember($cacheKey, now()->addHours(6), function () use ($slug) {
            return artikel_model::with(['kategori', 'penulis'])
                    ->published()
                    ->where('slug', $slug)
                    ->firstOrFail();
        });

        // Artikel terkait (cache terpisah)
        $relatedCacheKey = "guest_article_{$article->id}_related";
        $relatedArticles = Cache::remember($relatedCacheKey, now()->addHours(3), function () use ($article) {
            return artikel_model::with('kategori')
                    ->published()
                    ->where('kategori_id', $article->kategori_id)
                    ->where('id', '!=', $article->id)
                    ->latest('published_at')
                    ->take(3)
                    ->get();
        });

        // Artikel Terbaru (global)
    $latestCacheKey = "guest_latest_articles";
    $latestArticles = Cache::remember($latestCacheKey, now()->addHours(2), function () {
        return artikel_model::with('kategori')
                ->published()
                ->latest('published_at')
                ->take(5)
                ->get();
    });

    $recommendedCacheKey = "guest_recommended_articles_except_{$article->id}";
    $recommendedArticles = Cache::remember($recommendedCacheKey, now()->addHours(2), function () use ($article) {
        return artikel_model::with('kategori')
                ->published()
                ->where('id', '!=', $article->id)
                ->inRandomOrder()
                ->take(5)
                ->get();
    });

    return view('guest.artikel.show', compact(
        'article',
        'relatedArticles',
        'latestArticles',
        'recommendedArticles'
    ));
    }
}