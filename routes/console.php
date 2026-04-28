<?php

use App\Jobs\SyncDokterFromApi;
use App\Jobs\SyncPoliklinikFromApi;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::job(new SyncPoliklinikFromApi)->everyMinute()->before(function () {
    Log::info('Poliklinik sync dijalankan dulu');
});

Schedule::job(new SyncDokterFromApi)->everyThirtyMinutes()->after(function () {
    Log::info('Dokter sync setelah poli');
});