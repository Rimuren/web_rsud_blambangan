<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\poliklinik_model;
use App\Services\PoliklinikService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;

class PoliklinikController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('permission:poliklinik.view', only: ['index']),
            new Middleware('permission:poliklinik.create', only: ['create', 'store']),
            new Middleware('permission:poliklinik.update', only: ['edit', 'update']),
            new Middleware('permission:poliklinik.delete', only: ['destroy']),
        ];
    }

    public function index(Request $request, PoliklinikService $service)
    {
        $polikliniks = $service->getPoliklinik($request);
        return view('admin.dokter.poliklinik.index', compact('polikliniks'));
    }

    public function create() {}

    public function store(Request $request) {}

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
