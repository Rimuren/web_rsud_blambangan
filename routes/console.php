<?php

use App\Jobs\FetchDokterFromApi;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::job(new FetchDokterFromApi)->daily();

Artisan::command('fetch:dokter', function () {
    FetchDokterFromApi::dispatchSync(); 
    $this->info('Job executed synchronously!');
})->purpose('Fetch dokter from API');