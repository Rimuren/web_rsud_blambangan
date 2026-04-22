<?php

namespace App\Http\Controllers;

use App\Http\Requests\JamOperasionalRequest;
use App\Models\JamOperasional;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class JamOperasionalController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('permission:jam_operasional.view', only: ['index']),
            new Middleware('permission:jam_operasional.view', only: ['create', 'store']),
            new Middleware('permission:jam_operasional.update', only: ['edit', 'update']),
            new Middleware('permission:jam_operasional.delete', only: ['destroy']),
            new Middleware('permission:jam_operasional.toggle_status',only:['toggleStatus']),
        ];
    }

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
        $data = $request->validated();
        $data['is_closed'] = $request->boolean('is_closed');

        JamOperasional::create($data);

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
        $data = $request->validated();
        $data['is_closed'] = $request->boolean('is_closed');

        $jamOperasional->update($data);

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil diperbarui.');
    }

    public function toggleStatus(JamOperasional $jamOperasional): RedirectResponse
    {
        $newStatus = !$jamOperasional->is_closed;

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
