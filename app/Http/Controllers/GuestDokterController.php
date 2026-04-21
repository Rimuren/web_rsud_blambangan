<?php

namespace App\Http\Controllers;

use App\Services\DokterService;
use Illuminate\Http\Request;

class GuestDokterController extends Controller
{
    protected DokterService $dokterService;

    public function __construct(DokterService $dokterService)
    {
        $this->dokterService = $dokterService;
    }

    public function index(Request $request)
    {
        $data = $this->dokterService->getDokters($request);
        return view('guest.daftar-dokter.index', [
            'dokters' => $data['dokters'],
            'poliklinikList' => $data['poliklinikList'] ?? []
        ]);
    }
}
