<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class VersionInfoController extends Controller
{
    public function version()
    {
        $commit = $this->getCommit();
        $version = $this->getVersion($commit);
        $deployedAt = $this->getDeployedAt();

        return response()->json([
            'app' => config('app.name'),
            'environment' => app()->environment(),

            'version' => $version,
            'commit' => $commit ?? 'unknown',

            'live_commit_sha' => $commit,
            'sha' => $commit,

            'commit_short' => $commit ? substr($commit, 0, 7) : null,
            'deployed_at' => $deployedAt,
            'generated_at' => Carbon::now()->toIso8601String(),
        ]);
    }

    private function getCommit()
    {
        if ($env = config('app.commit')) return $env;

        foreach (['REVISION', '.commit_sha'] as $file) {
            if (File::exists(base_path($file))) {
                return trim(File::get(base_path($file)));
            }
        }

        if (File::exists(base_path('.git/HEAD'))) {
            $head = trim(File::get(base_path('.git/HEAD')));

            if (str_starts_with($head, 'ref:')) {
                $ref = trim(str_replace('ref:', '', $head));
                $refPath = base_path('.git/' . $ref);

                if (File::exists($refPath)) {
                    return trim(File::get($refPath));
                }
            } else {
                return $head;
            }
        }

        return null;
    }

    private function getVersion($commit)
    {
        if ($env = config('app.version')) return $env;

        foreach (['VERSION', '.version'] as $file) {
            if (File::exists(base_path($file))) {
                return trim(File::get(base_path($file)));
            }
        }

        return $commit ? 'git-' . substr($commit, 0, 7) : 'unknown';
    }

    private function getDeployedAt()
    {
        if ($env = config('app.deployed_at')) {
            return $env;
        }

        foreach (['DEPLOYED_AT', '.deployed_at'] as $file) {
            $path = base_path($file);
            if (File::exists($path)) {
                return trim(File::get($path));
            }
        }

        foreach (['DEPLOYED_AT', '.deployed_at', 'REVISION', '.commit_sha'] as $file) {
            $path = base_path($file);
            if (File::exists($path)) {
                return Carbon::createFromTimestamp(
                    File::lastModified($path)
                )->toIso8601String();
            }
        }

        return null;
    }
}
