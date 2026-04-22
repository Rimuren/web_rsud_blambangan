<?php

namespace App\Http\Controllers;

use App\Http\Requests\JamOperasionalRequest;
use App\Models\jam_operasional;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JamOperasionalController extends Controller
{
    public function index(): View
    {
        $jam_operasionals = jam_operasional::query()
            ->orderBy('hari')
            ->paginate(10);

        return view('admin.jam-operasional.index', [
            'jam_operasionals' => $jam_operasionals,
        ]);
    }

    public function create(): View
    {
        return view('admin.jam-operasional.create', [
            'hariOptions' => jam_operasional::HARI_OPTIONS,
        ]);
    }

    public function store(JamOperasionalRequest $request): RedirectResponse
    {
        jam_operasional::create($request->validated() + [
            'is_closed' => $request->boolean('is_closed'),
        ]);

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil ditambahkan.');
    }

    public function edit(jam_operasional $jam_operasionals): View
    {
        return view('admin.jam-operasional.edit', [
            'jam_operasional' => $jam_operasionals,
            'hariOptions' => jam_operasional::HARI_OPTIONS,
        ]);
    }

    public function update(JamOperasionalRequest $request, jam_operasional $jam_operasionals): RedirectResponse
    {
        $jam_operasionals->update($request->validated() + [
            'is_closed' => $request->boolean('is_closed'),
        ]);

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil diperbarui.');
    }

    public function toggleStatus(jam_operasional $jam_operasionals): RedirectResponse
    {
        $newStatus = !$jam_operasionals->is_closed;

        if (!$newStatus && (!$jam_operasionals->jam_buka || !$jam_operasionals->jam_tutup)) {
            return redirect()
                ->route('admin.jam-operasional.index')
                ->with('error', 'Status tidak bisa diubah ke buka karena jam buka dan jam tutup belum lengkap.');
        }

        $jam_operasionals->update([
            'is_closed' => $newStatus,
        ]);

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Status jam operasional berhasil diperbarui.');
    }

    public function destroy(jam_operasional $jam_operasionals): RedirectResponse
    {
        $jam_operasionals->delete();

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil dihapus.');
    }
}
