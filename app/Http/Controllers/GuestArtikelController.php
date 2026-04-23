<?php
namespace App\Http\Controllers;
use App\Models\artikel_model;
use App\Models\kategori_artikel_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class GuestArtikelController extends Controller
{
    public function index(Request $request)
    {
        $query = artikel_model::with(['kategori', 'penulis'])
                    ->published()
                    ->orderBy('published_at', 'desc');

        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $articles   = $query->paginate(9);
        $categories = kategori_artikel_model::orderBy('nama')->get();

        return view('guest.artikel.index', compact('articles', 'categories'));
    }

    public function show($slug)
    {
        $article = artikel_model::with(['kategori', 'penulis'])
                    ->published()
                    ->where('slug', $slug)
                    ->firstOrFail();

        // === INCREMENT VIEWS ===
        $cookieKey = 'viewed_' . $article->id;
        $hasViewed = Cookie::get($cookieKey);

        if (!$hasViewed) {
            $article->increment('views');
        }

        // === REKOMENDASI ===
        $recommendedArticles = artikel_model::with('kategori')
            ->published()
            ->where('kategori_id', $article->kategori_id)
            ->where('id', '!=', $article->id)
            ->orderBy('views', 'desc')
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        if ($recommendedArticles->count() < 5) {
            $needed     = 5 - $recommendedArticles->count();
            $excludeIds = $recommendedArticles->pluck('id')->push($article->id);
            $popular    = artikel_model::published()
                ->whereNotIn('id', $excludeIds)
                ->orderBy('views', 'desc')
                ->orderBy('published_at', 'desc')
                ->take($needed)
                ->get();
            $recommendedArticles = $recommendedArticles->concat($popular);
        }

        if ($recommendedArticles->count() < 5) {
            $needed     = 5 - $recommendedArticles->count();
            $excludeIds = $recommendedArticles->pluck('id')->push($article->id);
            $latest     = artikel_model::published()
                ->whereNotIn('id', $excludeIds)
                ->orderBy('published_at', 'desc')
                ->take($needed)
                ->get();
            $recommendedArticles = $recommendedArticles->concat($latest);
        }

        // === ARTIKEL TERKAIT ===
        $relatedArticles = artikel_model::with('kategori')
            ->published()
            ->where('kategori_id', $article->kategori_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        // === ARTIKEL TERBARU ===
        $latestArticles = artikel_model::with('kategori')
            ->published()
            ->latest('published_at')
            ->take(5)
            ->get();

        // === RETURN + PASANG COOKIE DI RESPONSE ===
        $response = response()->view('guest.artikel.show', compact(
            'article',
            'relatedArticles',
            'latestArticles',
            'recommendedArticles'
        ));

        if (!$hasViewed) {
            $response->withCookie(Cookie::make($cookieKey, 1, 20));
        }

        return $response;
    }
}