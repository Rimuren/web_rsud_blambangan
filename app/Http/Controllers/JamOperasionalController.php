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
    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    */
    public static function middleware()
    {
        return [
            new Middleware('permission:jam_operasional.view', only: ['index']),
            new Middleware('permission:jam_operasional.create', only: ['create', 'store']),
            new Middleware('permission:jam_operasional.update', only: ['edit', 'update']),
            new Middleware('permission:jam_operasional.delete', only: ['destroy']),
            new Middleware('permission:jam_operasional.toggle_status', only: ['toggleStatus']),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index(): View
    {
        $jamOperasionalList = JamOperasional::orderBy('hari')
            ->paginate(10);

        return view('admin.jam-operasional.index', compact('jamOperasionalList'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create(): View
    {
        $hariOptions = JamOperasional::HARI_OPTIONS;

        return view('admin.jam-operasional.create', compact('hariOptions'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(JamOperasionalRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_closed'] = $request->boolean('is_closed');

        JamOperasional::create($data);

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit(JamOperasional $jamOperasional): View
    {
        $hariOptions = JamOperasional::HARI_OPTIONS;

        return view('admin.jam-operasional.edit', compact('jamOperasional', 'hariOptions'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(
        JamOperasionalRequest $request,
        JamOperasional $jamOperasional
    ): RedirectResponse {
        $data = $request->validated();
        $data['is_closed'] = $request->boolean('is_closed');

        $jamOperasional->update($data);

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | TOGGLE STATUS
    |--------------------------------------------------------------------------
    */
    public function toggleStatus(JamOperasional $jamOperasional): RedirectResponse
    {
        $jamOperasional->update([
            'is_closed' => !$jamOperasional->is_closed,
        ]);

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Status jam operasional berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy(JamOperasional $jamOperasional): RedirectResponse
    {
        $jamOperasional->delete();

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil dihapus.');
    }
}
