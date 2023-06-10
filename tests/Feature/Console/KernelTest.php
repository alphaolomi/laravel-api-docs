<?php

use Illuminate\Console\Scheduling\Schedule;
use Symfony\Component\Process\Process;

it('can schedule run schedule:run', function () {
    $schedule = app(Schedule::class);
    $events = collect($schedule->events());
    $isEmpty = $events->isEmpty();
    $empty = 'No scheduled commands are ready to run.';

    $process = Process::fromShellCommandline('php artisan schedule:run', null, null, null, 3);
    $process->run();

    expect($process->getOutput())
        ->toContain($isEmpty ? $empty : 'Next Due:');

    $process->stop();
})->group('flaky');
