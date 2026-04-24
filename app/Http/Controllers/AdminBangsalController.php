<?php

namespace App\Http\Controllers;

use App\Services\BedService;
use Illuminate\Http\Request;

class AdminBangsalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(BedService $bedService)
    {
        $data = $bedService->getBeds();

        // Hitung statistik
        $totalKapasitas = 0;
        $totalTerisi = 0;
        $totalKosong = 0;

        foreach ($data as $b) {
            foreach ($b['kelas'] as $k) {
                $totalKapasitas += $k['kapasitas'];
                $totalTerisi += $k['terisi'];
                $totalKosong += $k['kosong'];
            }
        }

        $occupancy = $totalKapasitas > 0
            ? round(($totalTerisi / $totalKapasitas) * 100)
            : 0;

        return view('admin.manajemen-ruangan.bangsal.index', compact(
            'data',
            'totalKapasitas',
            'totalTerisi',
            'totalKosong',
            'occupancy'
        ));
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
