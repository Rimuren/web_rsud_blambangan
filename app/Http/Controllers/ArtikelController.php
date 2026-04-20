<?php

namespace App\Http\Controllers;

use App\Models\artikel_model;
use App\Models\kategori_artikel_model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
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
            $data['thumbnail'] = $this->uploadThumbnail($request->file('thumbnail'));
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
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => 'in:draft,published',
        ]);

        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
            'kategori_id' => $request->kategori_id,
            'status' => $request->status,
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->uploadThumbnail(
                $request->file('thumbnail'),
                $artikel->thumbnail
            );
        }

        if ($request->status === 'published' && $artikel->status !== 'published') {
            $data['published_at'] = now();
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

public function destroy(artikel_model $artikel)
{
    if ($artikel->thumbnail && Storage::disk('public')->exists($artikel->thumbnail)) {
        Storage::disk('public')->delete($artikel->thumbnail);
    }

    $artikel->delete();

    return redirect()->route('admin.artikel.index')
        ->with('success', 'Artikel berhasil dihapus.');
}

    public function massDestroy(Request $request)
    {
        $ids = $request->input('ids');
        if (!$ids || !is_array($ids)) {
            return redirect()->back()->with('error', 'Tidak ada artikel yang dipilih.');
        }
        artikel_model::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', count($ids) . ' artikel berhasil dihapus.');
    }

    private function uploadThumbnail($file, $oldFile = null)
    {
        if ($oldFile && Storage::disk('public')->exists($oldFile)) {
            Storage::disk('public')->delete($oldFile);
        }

        $filename = 'artikel-' . now()->timestamp . '-' . Str::random(6) . '.webp';
        $path = "artikel-thumbnails/{$filename}";

        // GD native
        $source = $file->getPathname();
        list($width, $height, $type) = getimagesize($source);

        $img = $this->createImageFromFile($source, $type);
        if (!$img) {
            // Fallback simpan asli
            return $file->store('artikel-thumbnails', 'public');
        }

        // Crop ke 1200x630 (center)
        $targetWidth = 1200;
        $targetHeight = 630;
        $srcRatio = $width / $height;
        $dstRatio = $targetWidth / $targetHeight;

        if ($srcRatio > $dstRatio) {
            $cropWidth = $height * $dstRatio;
            $cropHeight = $height;
            $srcX = ($width - $cropWidth) / 2;
            $srcY = 0;
        } else {
            $cropWidth = $width;
            $cropHeight = $width / $dstRatio;
            $srcX = 0;
            $srcY = ($height - $cropHeight) / 2;
        }

        $cropped = imagecreatetruecolor($targetWidth, $targetHeight);
        imagecopyresampled($cropped, $img, 0, 0, $srcX, $srcY, $targetWidth, $targetHeight, $cropWidth, $cropHeight);
        imagedestroy($img);

        // Simpan sebagai WebP
        ob_start();
        imagewebp($cropped, null, 80);
        $webpData = ob_get_clean();
        imagedestroy($cropped);

        Storage::disk('public')->put($path, $webpData);
        return $path;
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120'
        ]);

        $file = $request->file('image');
        $filename = 'artikel-' . now()->timestamp . '-' . Str::random(6) . '.webp';
        $path = "artikel-images/{$filename}";

        $source = $file->getPathname();
        list($width, $height, $type) = getimagesize($source);

        $img = $this->createImageFromFile($source, $type);
        if (!$img) {
            // Fallback simpan asli
            $path = $file->store('artikel-images', 'public');
            $url = Storage::url($path);
            return response()->json(['url' => $url]);
        }

        // Resize jika lebar > 1200
        if ($width > 1200) {
            $newHeight = ($height / $width) * 1200;
            $resized = imagecreatetruecolor(1200, (int)$newHeight);
            imagecopyresampled($resized, $img, 0, 0, 0, 0, 1200, (int)$newHeight, $width, $height);
            imagedestroy($img);
            $img = $resized;
        }

        ob_start();
        imagewebp($img, null, 80);
        $webpData = ob_get_clean();
        imagedestroy($img);

        Storage::disk('public')->put($path, $webpData);
        $url = Storage::url($path);

        return response()->json(['url' => $url]);
    }

    // Helper untuk membuat resource gambar dari berbagai tipe
    private function createImageFromFile($source, $type)
    {
        switch ($type) {
            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($source);
            case IMAGETYPE_PNG:
                $img = imagecreatefrompng($source);
                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);
                return $img;
            case IMAGETYPE_WEBP:
                return imagecreatefromwebp($source);
            default:
                return null;
        }
    }
}