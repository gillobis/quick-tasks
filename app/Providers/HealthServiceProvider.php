<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DatabaseSizeCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Facades\Health;

class HealthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Health::checks([
            DatabaseSizeCheck::new()
                ->failWhenSizeAboveGb(errorThresholdGb: 0.5),
            DatabaseCheck::new(),
            ScheduleCheck::new()->heartbeatMaxAgeInMinutes(2),
        ]);
    }
}
