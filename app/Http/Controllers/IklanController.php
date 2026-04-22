<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class IklanController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('permission:artikel.view', only: ['index']),
            new Middleware('permission:artikel.create', only: ['create', 'store', 'uploadThumbnail', 'uploadImage', 'createImageFromFile']),
            new Middleware('permission:artikel.update', only: ['edit', 'update']),
            new Middleware('permission:artikel.delete', only: ['destroy', 'massDestroy']),
        ];
    }

    public function index(): View
    {
        $iklans = Iklan::latest()->paginate(10);
        return view('admin.iklan.index', compact('iklans'));
    }

    public function create(): View
    {
        return view('admin.iklan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules(true), $this->messages());

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('iklans', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['cta_label'] = $validated['cta_label'] ?? null;
        $validated['cta_url'] = $validated['cta_url'] ?? null;

        Iklan::create($validated);

        return redirect()
            ->route('admin.iklan.index')
            ->with('success', 'Iklan berhasil ditambahkan.');
    }

    public function edit(Iklan $iklan): View
    {
        return view('admin.iklan.edit', compact('iklan'));
    }

    public function update(Request $request, Iklan $iklan): RedirectResponse
    {
        $validated = $request->validate($this->rules(false), $this->messages());

        if ($request->hasFile('gambar')) {
            $newPath = $request->file('gambar')->store('iklans', 'public');
            $oldPath = $iklan->gambar;
            $validated['gambar'] = $newPath;

            if ($oldPath) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['cta_label'] = $validated['cta_label'] ?? null;
        $validated['cta_url'] = $validated['cta_url'] ?? null;

        $iklan->update($validated);

        return redirect()
            ->route('admin.iklan.index')
            ->with('success', 'Iklan berhasil diperbarui.');
    }

    public function toggleStatus(Iklan $iklan): RedirectResponse
    {
        $iklan->update([
            'is_active' => !$iklan->is_active,
        ]);

        return redirect()
            ->route('admin.iklan.index')
            ->with('success', 'Status iklan berhasil diperbarui.');
    }

    public function destroy(Iklan $iklan): RedirectResponse
    {
        if ($iklan->gambar) {
            Storage::disk('public')->delete($iklan->gambar);
        }

        $iklan->delete();

        return redirect()
            ->route('admin.iklan.index')
            ->with('success', 'Iklan berhasil dihapus.');
    }

    private function rules(bool $isCreate = false): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'gambar' => [$isCreate ? 'required' : 'nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'deskripsi' => ['nullable', 'string'],
            'cta_label' => ['nullable', 'string', 'max:50', 'required_with:cta_url'],
            'cta_url' => ['nullable', 'url', 'max:255', 'required_with:cta_label'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    private function messages(): array
    {
        return [
            'cta_label.required_with' => 'Teks tombol aksi wajib diisi jika link tombol aksi diisi.',
            'cta_url.required_with' => 'Link tombol aksi wajib diisi jika teks tombol aksi diisi.',
        ];
    }
}
