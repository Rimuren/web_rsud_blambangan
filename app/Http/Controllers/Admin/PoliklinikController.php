<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\poliklinik_model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;

class PoliklinikController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('permission:poliklinik.view', only: ['index']),
            new Middleware('permission:poliklinik.create', only: ['create', 'store']),
            new Middleware('permission:poliklinik.update', only: ['edit', 'update']),
            new Middleware('permission:poliklinik.delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $polikliniks = poliklinik_model::orderBy('nama')->paginate(15);
        return view('admin.dokter.poliklinik.index', compact('polikliniks'));
    }

    public function create()
    {
        return view('admin.dokter.poliklinik.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:poliklinik,nama',
            'kode_bpjs' => 'nullable|string|max:20',
            'image' => 'nullable|string',
            'background_img' => 'nullable|string',
            'tarif_konsultasi' => 'nullable|integer',
        ]);

        $validated['source'] = 'manual';
        $validated['is_active'] = true;

        poliklinik_model::create($validated);

        return redirect()->route('admin.dokter.poliklinik.index')
            ->with('success', 'Poliklinik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $poliklinik = poliklinik_model::findOrFail($id);
        return view('admin.dokter.poliklinik.edit', compact('poliklinik'));
    }

    public function update(Request $request, $id)
    {
        $poliklinik = poliklinik_model::findOrFail($id);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100', Rule::unique('poliklinik')->ignore($poliklinik->id)],
            'kode_bpjs' => 'nullable|string|max:20',
            'image' => 'nullable|string',
            'background_img' => 'nullable|string',
            'tarif_konsultasi' => 'nullable|integer',
        ]);

        $poliklinik->update($validated);

        return redirect()->route('admin.dokter.poliklinik.index')
            ->with('success', 'Poliklinik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $poliklinik = poliklinik_model::findOrFail($id);
        // Cek apakah poliklinik sedang digunakan di jadwal_dokter
        if ($poliklinik->jadwal_dokter()->exists()) {
            return redirect()->route('admin.dokter.poliklinik.index')
                ->with('error', 'Poliklinik sedang digunakan, tidak dapat dihapus.');
        }
        $poliklinik->delete();

        return redirect()->route('admin.dokter.poliklinik.index')
            ->with('success', 'Poliklinik berhasil dihapus.');
    }
}
