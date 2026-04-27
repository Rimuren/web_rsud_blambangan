<?php

namespace App\Console\Commands;

use App\Jobs\SyncDokterFromApi;
use App\Jobs\SyncPoliklinikFromApi;
use Illuminate\Console\Command;

class SyncAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi semua data (poliklinik & dokter) dari API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mulai sinkronisasi SEMUA data...');

        // Urutan penting: poliklinik->dokter
        SyncPoliklinikFromApi::dispatch();
        $this->info('✔ Poliklinik queued');

        SyncDokterFromApi::dispatch();
        $this->info('✔ Dokter queued');

        $this->line('');
        $this->line('Jalankan queue worker: php artisan queue:work');

        return 0;
    }
}
