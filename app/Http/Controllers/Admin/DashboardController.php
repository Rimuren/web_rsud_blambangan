<?php

namespace App\Http\Controllers\Admin;

use App\Models\jam_operasional;
use App\Models\dokter_model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DashboardController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('permission:admin.access', only: ['index']),
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spesialisList = dokter_model::select('spesialis')
            ->distinct()
            ->whereNotNull('spesialis')
            ->pluck('spesialis')
            ->toArray();

        $jam_operasionals = jam_operasional::query()
            ->orderBy('hari')
            ->get();

        return view('guest.home.index', compact('spesialisList', 'jam_operasionals'));
        return view('admin.dashboard');
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
