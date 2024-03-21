<?php declare(strict_types=1);

namespace App\Console\Commands\Auth;

use App\Models\UserAuth;
use Illuminate\Console\Command;

class DeleteUserAuths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-user-auths';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'deletes all user auths if its too old';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        UserAuth::where('created_at', '<=', now()->subMinutes(15))->delete();
    }
}
