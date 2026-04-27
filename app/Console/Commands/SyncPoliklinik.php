<?php

namespace App\Console\Commands;

use App\Jobs\SyncPoliklinikFromApi;
use Illuminate\Console\Command;

class SyncPoliklinik extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:poliklinik';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi poliklinik dari API ke database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai sinkronisasi poliklinik...');

        SyncPoliklinikFromApi::dispatch();

        $this->info('Job SyncPoliklinikFromApi dikirim ke queue.');
        $this->line('Jalankan: php artisan queue:work');

        return 0;
    }
}
