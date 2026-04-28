<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\artikel_model;
use App\Models\dokter_model;
use App\Models\Iklan_model;
use App\Models\Jam_operasional_model;
use App\Models\poliklinik_model;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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


        $poliklinikList = poliklinik_model::pluck('nama')->toArray();

        $jam_operasionals = Jam_operasional_model::query()
            ->orderBy('hari')
            ->get();

        $popupIklans = Iklan_model::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $topArticles = artikel_model::query()
            ->with(['kategori', 'penulis'])
            ->published()
            ->orderByDesc('views')
            ->orderByDesc('published_at')
            ->take(6)
            ->get();

        $topArticleCategories = $topArticles
            ->pluck('kategori.nama')
            ->filter()
            ->unique()
            ->take(4)
            ->values();

        return view('guest.home.index', compact(
            'spesialisList',
            'jam_operasionals',
            'popupIklans',
            'topArticles',
            'topArticleCategories',
            'poliklinikList'
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
