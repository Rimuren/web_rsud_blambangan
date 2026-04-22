<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class VideoController extends Controller implements HasMiddleware
{
    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    */
    public static function middleware()
    {
        return [
            new Middleware('permission:video.view', only: ['index']),
            new Middleware('permission:video.create', only: ['create', 'store']),
            new Middleware('permission:video.update', only: ['edit', 'update']),
            new Middleware('permission:video.delete', only: ['destroy']),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Helper
    |--------------------------------------------------------------------------
    */

    private function extractYoutubeId(string $url): ?string
    {
        $patterns = [
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/',
            '/youtube\.com\/watch\?.*v=([a-zA-Z0-9_-]{11})/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $match)) {
                return $match[1];
            }
        }

        return null;
    }

    private function thumbnailUrl(string $id): string
    {
        return "https://img.youtube.com/vi/{$id}/hqdefault.jpg";
    }

    /*
    |--------------------------------------------------------------------------
    | GUEST
    |--------------------------------------------------------------------------
    */

    public function guestIndex()
    {
        $videos = Video::latest()->paginate(12);

        return view('guest.galeri.video.index', compact('videos'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $videos = Video::latest()->paginate(10);

        return view('admin.dokumentasi.video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.dokumentasi.video.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:255',
            'link'      => 'required|url',
            'deskripsi' => 'nullable|string',
            'kategori'  => 'nullable|string|max:100',
        ]);

        $youtubeId = $this->extractYoutubeId($data['link']);

        if (!$youtubeId) {
            return back()->withErrors(['link' => 'Link YouTube tidak valid'])->withInput();
        }

        if (Video::where('youtube_id', $youtubeId)->exists()) {
            return back()->withErrors(['link' => 'Video sudah ada'])->withInput();
        }

        $data['youtube_id'] = $youtubeId;
        $data['thumbnail']  = $this->thumbnailUrl($youtubeId);

        Video::create($data);

        return redirect()
            ->route('admin.dokumentasi.video.index')
            ->with('success', 'Video berhasil ditambahkan');
    }

    public function edit(Video $video)
    {
        return view('admin.dokumentasi.video.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:255',
            'link'      => 'required|url',
            'deskripsi' => 'nullable|string',
            'kategori'  => 'nullable|string|max:100',
        ]);

        $youtubeId = $this->extractYoutubeId($data['link']);

        if (!$youtubeId) {
            return back()->withErrors(['link' => 'Link YouTube tidak valid'])->withInput();
        }

        if (
            $youtubeId !== $video->youtube_id &&
            Video::where('youtube_id', $youtubeId)->exists()
        ) {
            return back()->withErrors(['link' => 'Video sudah ada'])->withInput();
        }

        $data['youtube_id'] = $youtubeId;
        $data['thumbnail']  = $this->thumbnailUrl($youtubeId);

        $video->update($data);

        return redirect()
            ->route('admin.dokumentasi.video.index')
            ->with('success', 'Video berhasil diperbarui');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()
            ->route('admin.dokumentasi.video.index')
            ->with('success', 'Video berhasil dihapus');
    }
}
