<?php

namespace App\Console\Commands\Auth;

use App\Models\UserPhoneChange;
use Illuminate\Console\Command;

class DeleteUserPhoneChanges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-user-phone-changes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'deletes all user phone changes if its too old';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UserPhoneChange::where('created_at', '<=', now()->subMinutes(30))->delete();
    }
}
