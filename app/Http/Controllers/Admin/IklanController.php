<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class IklanController extends Controller implements HasMiddleware
{
    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    */
    public static function middleware()
    {
        return [
            new Middleware('permission:iklan.view', only: ['index']),
            new Middleware('permission:iklan.create', only: ['create', 'store']),
            new Middleware('permission:iklan.update', only: ['edit', 'update', 'toggleStatus']),
            new Middleware('permission:iklan.delete', only: ['destroy']),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index(): View
    {
        $iklanList = Iklan::latest()->paginate(10);

        return view('admin.iklan.index', compact('iklanList'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create(): View
    {
        return view('admin.iklan.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules(true), $this->messages());

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('iklans', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        Iklan::create($data);

        return redirect()
            ->route('admin.iklan.index')
            ->with('success', 'Iklan berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit(Iklan $iklan): View
    {
        return view('admin.iklan.edit', compact('iklan'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Iklan $iklan): RedirectResponse
    {
        $data = $request->validate($this->rules(false), $this->messages());

        if ($request->hasFile('gambar')) {
            if ($iklan->gambar) {
                Storage::disk('public')->delete($iklan->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('iklans', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $iklan->update($data);

        return redirect()
            ->route('admin.iklan.index')
            ->with('success', 'Iklan berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | TOGGLE STATUS
    |--------------------------------------------------------------------------
    */
    public function toggleStatus(Iklan $iklan): RedirectResponse
    {
        $iklan->update([
            'is_active' => !$iklan->is_active,
        ]);

        return redirect()
            ->route('admin.iklan.index')
            ->with('success', 'Status iklan berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */
    private function rules(bool $isCreate = false): array
    {
        return [
            'nama'       => ['required', 'string', 'max:255'],
            'gambar'     => [$isCreate ? 'required' : 'nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'deskripsi'  => ['nullable', 'string'],
            'cta_label'  => ['nullable', 'string', 'max:50', 'required_with:cta_url'],
            'cta_url'    => ['nullable', 'url', 'max:255', 'required_with:cta_label'],
            'is_active'  => ['nullable', 'boolean'],
        ];
    }

    private function messages(): array
    {
        return [
            'cta_label.required_with' => 'Teks tombol aksi wajib diisi jika link diisi.',
            'cta_url.required_with'   => 'Link tombol aksi wajib diisi jika teks diisi.',
        ];
    }
}
