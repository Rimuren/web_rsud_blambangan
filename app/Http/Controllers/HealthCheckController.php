<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HealthCheckController extends Controller
{
    public function health()
    {
        $dbStatus = 'ok';
        $dbMessage = 'Database connection is healthy.';

        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $dbStatus = 'down';
            $dbMessage = $e->getMessage();
        }

        $status = $dbStatus === 'ok' ? 'ok' : 'degraded';

        $data = [
            'status' => $status,
            'app' => config('app.name'),
            'environment' => app()->environment(),
            'timestamp' => Carbon::now()->toIso8601String(),
            'checks' => [
                'database' => [
                    'status' => $dbStatus,
                    'message' => $dbMessage,
                    'connection' => Config::get('database.default'),
                ]
            ]
        ];

        return response()->json(
            $data,
            $status === 'ok' ? 200 : 503
        );
    }

    public function status(Request $request)
    {
        $data = $this->health()->getData(true);

        // Support JSON fallback
        if ($request->expectsJson()) {
            return response()->json($data);
        }

        return view('status', compact('data'));
    }
}
