<?php declare(strict_types=1);

namespace App\Console\Commands\Vacancy;

use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DisableVacancies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:disable-vacancies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'disables all vacancies, where payed_at is expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Vacancy::whereHas('payments', function($q) {
            $q->where('status', '=', 'completed')
                ->where('payed_at', '!=', null)
                ->whereDate('payed_at', '<=', Carbon::now()->subDays(30)->toDateString());
        })
        ->update([
            'is_active' => false
        ]);
    }
}
