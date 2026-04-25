<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\DokterService;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    protected DokterService $dokterService;

    public function __construct(DokterService $dokterService)
    {
        $this->dokterService = $dokterService;
    }

    public function index(Request $request)
    {
        $data = $this->dokterService->getDokters($request);
        $dokters = $data['dokters'];

        $dokters->withPath(route('guest.daftar-dokter.index'));

        return view('guest.daftar-dokter.index', [
            'dokters' => $dokters,
            'poliklinikList' => $data['poliklinikList'] ?? []
        ]);
    }
}
