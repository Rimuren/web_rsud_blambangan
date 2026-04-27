<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class AppMetadataService
{
  public function getCommit()
  {
    return config('app.commit_sha')
      ?? $this->getFileContent('REVISION')
      ?? $this->getFileContent('.commit_sha')
      ?? $this->getGitHash()
      ?? 'unknown';
  }

  public function getVersion()
  {
    return config('app.version')
      ?? $this->getFileContent('VERSION')
      ?? $this->getFileContent('.version')
      ?? ('git-' . substr($this->getCommit(), 0, 7));
  }

  private function getFileContent($filename)
  {
    if (File::exists(base_path($filename))) {
      return trim(File::get(base_path($filename)));
    }
    return null;
  }

  private function getGitHash()
  {
    if (File::exists(base_path('.git/HEAD'))) {
      $head = explode(' ', File::get(base_path('.git/HEAD')));
      if (isset($head[1])) {
        $path = base_path('.git/' . trim($head[1]));
        return File::exists($path) ? trim(File::get($path)) : null;
      }
    }
    return null;
  }
}
