<?php

namespace App\Console\Commands\Company;

use App\Models\Company;
use Illuminate\Console\Command;

class DeleteCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'deletes all companies if they dont verify too long';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Company::where('created_at', '<=', now()->subDays(7))
            ->whereRelation('document', 'is_verified', '=', 'false')
            ->delete();
    }
}
