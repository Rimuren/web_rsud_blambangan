<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HealthCheckController extends Controller
{
    public function check(Request $request)
    {
        $dbStatus = 'ok';
        $dbMessage = 'Database connection is healthy.';

        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $dbStatus = 'degraded';
            $dbMessage = $e->getMessage();
        }

        $payload = [
            'status' => $dbStatus === 'ok' ? 'ok' : 'degraded',
            'app' => config('app.name'),
            'environment' => app()->environment(),
            'timestamp' => now()->toIso8601String(),
            'checks' => [
                'database' => [
                    'status' => $dbStatus,
                    'message' => $dbMessage,
                    'connection' => config('database.default'),
                ],
            ],
        ];

        if ($request->is('status') || $request->wantsJson()) {
            return response()->json($payload, $dbStatus === 'ok' ? 200 : 503);
        }

        return view('status', compact('payload'));
    }
}
