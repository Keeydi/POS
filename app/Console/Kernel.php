<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\DailyBackup::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Daily backup at end of day (11:59 PM)
        $schedule->command('backup:daily')
            ->dailyAt('23:59')
            ->timezone('Asia/Manila');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
