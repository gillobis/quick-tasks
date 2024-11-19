<?php

use App\Jobs\NotifyExpiringTask;
use App\Models\Task;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    foreach (Task::expiring()->get() as $task) {
        NotifyExpiringTask::dispatch($task);
    }
})->dailyAt('07:00');

Schedule::command('backup:clean')->daily()->at('01:00');
Schedule::command('backup:run')->daily()->at('01:30');
Schedule::command('model:prune', [
    '--model' => [
        \Spatie\Health\Models\HealthCheckResultHistoryItem::class,
    ],
])->daily();

Schedule::command(\Spatie\Health\Commands\RunHealthChecksCommand::class)->everyMinute();
