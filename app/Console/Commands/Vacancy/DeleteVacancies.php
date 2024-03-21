<?php declare(strict_types=1);

namespace App\Console\Commands\Vacancy;

use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteVacancies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-vacancies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'deletes all vacancies if they not payed for 1 day';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Vacancy::where('is_active','=',false)
            ->whereDoesntHave('payments', function($q) {
                $q->where('status','=', 'completed')
                ->where('payed_at','!=', null)
                ->whereDate('payed_at', '<=', Carbon::now()->subDays(30)->toDateString());
            })
            ->delete();
    }
}
