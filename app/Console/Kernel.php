<?php declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:delete-user-auths')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->onOneServer();
        $schedule->command('app:delete-user-phone-changes')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->onOneServer();
        $schedule->command('app:delete-companies')
            ->daily()
            ->withoutOverlapping()
            ->onOneServer();
        $schedule->command('app:delete-vacancies')
            ->daily()
            ->withoutOverlapping()
            ->onOneServer();
        $schedule->command('app:disable-vacancies')
            ->daily()
            ->withoutOverlapping()
            ->onOneServer();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
