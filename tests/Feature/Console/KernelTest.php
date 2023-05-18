<?php

// it can schedule work

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Artisan;
use function Pest\Laravel\artisan;
use Symfony\Component\Process\Process;

it('can schedule run schedule:run', function () {
    $schedule = app(Schedule::class);
    $events = collect($schedule->events());
    $isEmpty = $events->isEmpty();
    $mpty = 'No scheduled commands are ready to run.';

    $process = Process::fromShellCommandline('php artisan schedule:run', null, null, null, 3);
    $process->run();

    expect($process->getOutput())->toContain(
        $isEmpty ? $mpty : 'Next Due:'
    );

    $process->stop();
})->group('flaky');

// it('can schedule work', function () {

//     $schedule = app(Schedule::class);
//     $events = collect($schedule->events());
//     $isEmpty = $events->isEmpty();
//     $mpty = 'No scheduled tasks have been defined.';

//     $process = Process::fromShellCommandline('php artisan schedule:work',null, null,null, 3);

//     $process->run();

//     expect($process->getOutput())->toContain(
//         $isEmpty ? $mpty : 'Next Due:'
//     );

//     $process->stop();
// });
