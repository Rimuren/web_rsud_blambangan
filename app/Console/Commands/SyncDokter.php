<?php

namespace App\Console\Commands;

use App\Jobs\SyncDokterFromApi;
use Illuminate\Console\Command;

class SyncDokter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:dokter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi dokter dari API ke database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai sinkronisasi dokter...');
        SyncDokterFromApi::dispatch();
        $this->info('Job SyncDokterFromApi telah dikirim ke queue. Gunakan "php artisan queue:work" untuk menjalankannya.');
        return 0;
    }
}
