<?php

namespace App\Http\Controllers;

use App\Services\AppMetadataService;

class VersionInfoController extends Controller
{
    public function index(AppMetadataService $metadata)
    {
        $commit = $metadata->getCommit();

        return response()->json([
            'app' => config('app.name'),
            'environment' => app()->environment(),
            'version' => $metadata->getVersion(),
            'commit' => $commit,
            'commit_short' => substr($commit, 0, 7),
            'deployed_at' => config('app.deployed_at') ?? 'N/A', 
            'generated_at' => now()->toIso8601String(),
        ]);
    }
}
