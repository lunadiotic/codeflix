<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule::command('memberships:check')
//     ->daily()
//     ->at('00:00')
//     ->timezone('Asia/Jakarta')
//     ->withoutOverlapping()
//     ->onOneServer()
//     ->evenInMaintenanceMode();

Schedule::command('memberships:check')->everyMinute();
