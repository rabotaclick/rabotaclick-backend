<?php declare(strict_types=1);
namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeleteRepository
{
    public function __construct(
        private User $user,
    )
    {
    }

    public function make(): string
    {
        $this->user = Auth::user();
        $this->user->delete();
        return $this->user->deleted_at->format('Y-m-d H:i:s');
    }
}
