<?php

namespace App\Http\Controllers;

use App\Http\Requests\JamOperasionalRequest;
use App\Models\JamOperasional;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JamOperasionalController extends Controller
{
    public function index(): View
    {
        $jamOperasionals = JamOperasional::query()
            ->orderBy('hari')
            ->paginate(10);

        return view('admin.jam-operasional.index', [
            'jamOperasionals' => $jamOperasionals,
        ]);
    }

    public function create(): View
    {
        return view('admin.jam-operasional.create', [
            'hariOptions' => JamOperasional::HARI_OPTIONS,
        ]);
    }

    public function store(JamOperasionalRequest $request): RedirectResponse
    {
        JamOperasional::create($request->validated() + [
            'is_closed' => $request->boolean('is_closed'),
        ]);

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil ditambahkan.');
    }

    public function edit(JamOperasional $jamOperasional): View
    {
        return view('admin.jam-operasional.edit', [
            'jamOperasional' => $jamOperasional,
            'hariOptions' => JamOperasional::HARI_OPTIONS,
        ]);
    }

    public function update(JamOperasionalRequest $request, JamOperasional $jamOperasional): RedirectResponse
    {
        $jamOperasional->update($request->validated() + [
            'is_closed' => $request->boolean('is_closed'),
        ]);

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil diperbarui.');
    }

    public function toggleStatus(JamOperasional $jamOperasional): RedirectResponse
    {
        $newStatus = !$jamOperasional->is_closed;

        if (!$newStatus && (!$jamOperasional->jam_buka || !$jamOperasional->jam_tutup)) {
            return redirect()
                ->route('admin.jam-operasional.index')
                ->with('error', 'Status tidak bisa diubah ke buka karena jam buka dan jam tutup belum lengkap.');
        }

        $jamOperasional->update([
            'is_closed' => $newStatus,
        ]);

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Status jam operasional berhasil diperbarui.');
    }

    public function destroy(JamOperasional $jamOperasional): RedirectResponse
    {
        $jamOperasional->delete();

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil dihapus.');
    }
}
