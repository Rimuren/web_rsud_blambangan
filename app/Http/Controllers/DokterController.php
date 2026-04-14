<?php

namespace App\Http\Controllers;

use App\Models\dokter_model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DokterController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view daftar-dokter', only: ['index']),
        ];
    }

    public function guestIndex(Request $request)
    {
        $query = dokter_model::with('jadwal_dokter');

        $request->validate([
            'search' => 'nullable|string|max:100|regex:/^[\w\s\-]+$/',
        ]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('spesialis', 'like', "%{$search}%");
            });
        }

        if ($request->filled('spesialis') && $request->spesialis != 'Semua Spesialis') {
            $query->where('spesialis', $request->spesialis);
        }

        if ($request->filled('hari')) {
            $query->whereHas('jadwal_dokter', function ($q) use ($request) {
                $q->where('hari', $request->hari);
            });
        }

        $dokters = $query->paginate(10)->withQueryString();

        $doctors = [];
        foreach ($dokters as $dokter) {
            $schedule = ['Senin' => 'Tutup', 'Selasa' => 'Tutup', 'Rabu' => 'Tutup', 'Kamis' => 'Tutup', 'Jumat' => 'Tutup', 'Sabtu' => 'Tutup'];
            foreach ($dokter->jadwal_dokter as $jadwal) {
                if ($jadwal->hari && $jadwal->jam_mulai && $jadwal->jam_selesai) {
                    $jam = $jadwal->jam_mulai . '-' . $jadwal->jam_selesai;
                    $schedule[$jadwal->hari] = $jam;
                }
            }

            $doctors[] = [
                'name'      => $dokter->nama,
                'spesialis' => $dokter->spesialis, 
                'img'       => $dokter->image_url,
                'schedule'  => $schedule,
            ];
        }

        $spesialisList = dokter_model::select('spesialis')
            ->distinct()
            ->whereNotNull('spesialis')
            ->pluck('spesialis')
            ->toArray();

        return view('guest.daftar-dokter.index', compact('doctors', 'spesialisList', 'dokters'));
    }

    /**
     * Display a listing of the resource.   
     */
    public function index(Request $request)
    {
        // VALIDATION LOGIC: filter input and filtering
        $validated = $request->validate([
            'search' => 'nullable|string|max:100|regex:/^[\w\s\-]+$/',
            'sort' => 'nullable|string|max:100|regex:/^[\w\s\-]+$/',
        ]);

        // QUERY BUILDING: start with jadwal_dokter relation
        $query = dokter_model::with('jadwal_dokter');

        // FILTER BY SPESIALIS
        if ($request->filled('spesialis')) {
            $query->where('spesialis', $request->spesialis);
        }

        // FILTER BY SEARCH (nama OR spesialis)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('spesialis', 'like', "%{$search}%");
            });
        }

        // PAGINATION WITH QUERY STRING
        $dokters = $query->paginate(10)->withQueryString();

        // DATA PREPARATION: // DATA PREPARATION: unique spesialis list for dropdown filtering
        $spesialisList = dokter_model::select('spesialis')->distinct()->whereNotNull('spesialis')->pluck('spesialis')->toArray();

        return view('admin.dokter.index', compact('dokters', 'spesialisList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
