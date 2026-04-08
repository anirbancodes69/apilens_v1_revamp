<?php

use App\Jobs\CheckEndpointJob;
use App\Models\Endpoint;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {

    Endpoint::where('is_active', true)
        ->where(function ($q) {
            $q->whereNull('last_checked_at')
              ->orWhereRaw(
                'EXTRACT(EPOCH FROM (NOW() - last_checked_at)) >= interval_seconds'
              );
        })
        ->each(function ($endpoint) {
            CheckEndpointJob::dispatch($endpoint);
        });

})->everyMinute();
