<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    // Helper: extract YouTube ID dari berbagai format URL
   private function extractYouTubeId($url)
{
    // Support berbagai format URL YouTube
    $patterns = [
        '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/',
        '/youtube\.com\/watch\?.*v=([a-zA-Z0-9_-]{11})/',
        '/youtube\.com\/v\/([a-zA-Z0-9_-]{11})/',
    ];
    
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
    }
    return null;
}

    // Helper: get thumbnail URL from YouTube ID
    private function getThumbnailUrl($youtubeId)
    {
        // Gunakan thumbnail HQ default (maxresdefault bisa saja tidak ada, fallback ke hqdefault)
        return "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg";
    }

    // ADMIN: index
    public function index()
    {
        $videos = Video::latest()->paginate(10);
        return view('admin.dokumentasi.video.index', compact('videos'));
    }

    // ADMIN: form create
    public function create()
    {
        return view('admin.dokumentasi.video.create');
    }

    // ADMIN: store
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link' => 'required|url',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:100',
        ]);

       $youtubeId = $this->extractYouTubeId($request->link);
if (!$youtubeId) {
    return back()->withErrors(['link' => 'Link YouTube tidak valid. Pastikan URL benar.'])->withInput();
}

// Cek duplikat
if (Video::where('youtube_id', $youtubeId)->exists()) {
    return back()->withErrors(['link' => 'Video ini sudah pernah ditambahkan.'])->withInput();
}

$thumbnail = "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg";

Video::create([
    'judul' => $request->judul,
    'link' => $request->link,
    'youtube_id' => $youtubeId,  // <-- pastikan ini terisi
    'thumbnail' => $thumbnail,
    'deskripsi' => $request->deskripsi,
    'kategori' => $request->kategori,
]);

        return redirect()->route('admin.dokumentasi.video.index')
                         ->with('success', 'Video berhasil ditambahkan.');
    }

    // ADMIN: edit
    public function edit(Video $video)
    {
        return view('admin.dokumentasi.video.edit', compact('video'));
    }

    // ADMIN: update
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link' => 'required|url',
            'deskripsi' => 'nullable|string',
            'kategori' => 'nullable|string|max:100',
        ]);

        $youtubeId = $this->extractYouTubeId($request->link);
        if (!$youtubeId) {
            return back()->withErrors(['link' => 'Link YouTube tidak valid.'])->withInput();
        }

        // Jika ID berubah, cek duplikat kecuali video itu sendiri
        if ($youtubeId !== $video->youtube_id && Video::where('youtube_id', $youtubeId)->exists()) {
            return back()->withErrors(['link' => 'Video dengan link ini sudah ada.'])->withInput();
        }

        $thumbnail = $this->getThumbnailUrl($youtubeId);

        $video->update([
            'judul' => $request->judul,
            'link' => $request->link,
            'youtube_id' => $youtubeId,
            'thumbnail' => $thumbnail,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.dokumentasi.video.index')
                         ->with('success', 'Video berhasil diperbarui.');
    }

    // ADMIN: destroy
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.dokumentasi.video.index')
                         ->with('success', 'Video berhasil dihapus.');
    }

    // GUEST: halaman publik (opsional)
    public function guestIndex()
    {
        $videos = Video::latest()->paginate(12);
        return view('guest.galeri.video.index', compact('videos'));
    }
}