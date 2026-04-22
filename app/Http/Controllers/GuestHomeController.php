<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use App\Models\JamOperasional;
use App\Models\artikel_model;
use App\Models\dokter_model;
use App\Models\poliklinik_model;
use Illuminate\Http\Request;

class GuestHomeController extends Controller
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

        $jamOperasionals = JamOperasional::query()
            ->orderBy('hari')
            ->get();

        $popupIklan = Iklan::query()
            ->where('is_active', true)
            ->latest()
            ->first();

        $topArticles = artikel_model::query()
            ->with('kategori')
            ->published()
            ->orderByDesc('views')
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        $topArticleCategories = $topArticles
            ->pluck('kategori.nama')
            ->filter()
            ->unique()
            ->take(4)
            ->values();

        return view('guest.home.index', compact(
            'spesialisList',
            'jamOperasionals',
            'popupIklan',
            'topArticles',
            'topArticleCategories'
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
