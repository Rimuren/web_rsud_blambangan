<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JamOperasionalRequest;
use App\Models\Jam_operasional_model;
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
        $jam_operasionalList = Jam_operasional_model::orderBy('hari')
            ->paginate(10);

        return view('admin.jam-operasional.index', compact('jam_operasionalList'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create(): View
    {
        $hariOptions = Jam_operasional_model::HARI_OPTIONS;

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

        Jam_operasional_model::create($data);

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit(Jam_operasional_model $jam_operasional): View
    {
        $hariOptions = Jam_operasional_model::HARI_OPTIONS;

        return view('admin.jam-operasional.edit', compact('jam_operasional', 'hariOptions'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(
        JamOperasionalRequest $request,
        Jam_operasional_model $jam_operasional
    ): RedirectResponse {
        $data = $request->validated();
        $data['is_closed'] = $request->boolean('is_closed');

        $jam_operasional->update($data);

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | TOGGLE STATUS
    |--------------------------------------------------------------------------
    */
    public function toggleStatus(Jam_operasional_model $jam_operasional): RedirectResponse
    {
        $jam_operasional->update([
            'is_closed' => !$jam_operasional->is_closed,
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
    public function destroy(Jam_operasional_model $jam_operasional): RedirectResponse
    {
        $jam_operasional->delete();

        return redirect()
            ->route('admin.jam-operasional.index')
            ->with('success', 'Jam operasional berhasil dihapus.');
    }
}
