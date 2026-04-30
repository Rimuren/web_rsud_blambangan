<?php

namespace App\Services;

use App\Models\poliklinik_model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class PoliklinikFallbackService
{
  public function fetch(Request $request): LengthAwarePaginator
  {
    $query = poliklinik_model::query();

    if ($request->filled('search')) {
      $search = strtolower($request->search);

      $query->where(function ($q) use ($search) {
        $q->whereRaw('LOWER(nama) like ?', ["%{$search}%"])
          ->orWhereRaw('LOWER(slug) like ?', ["%{$search}%"]);
      });
    }

    $clinics = $query->paginate(10)->withQueryString();

    Log::info('Fallback poliklinik dari database', [
      'total' => $clinics->total()
    ]);

    return $clinics;
  }
}
