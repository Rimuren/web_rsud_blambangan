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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) 
    {

        $validated = $request->validate([
            'search' => 'nullable|string|max:100|regex:/^[\w\s\-]+$/',
            'sort' => 'nullable|string|max:100|regex:/^[\w\s\-]+$/',
        ]);

        $query = dokter_model::with('jadwal_dokter');

        if ($request->filled('spesialis')) {
            $query->where('spesialis', $request->spesialis);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('spesialis', 'like', "%{$search}%");
            });
        }

        $dokters = $query->paginate(10)->withQueryString();

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
