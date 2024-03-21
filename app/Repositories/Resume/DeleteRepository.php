<?php declare(strict_types=1);
namespace App\Repositories\Resume;

use App\Models\Resume;
use App\Traits\PermissionTrait;
use Illuminate\Support\Facades\Auth;

class DeleteRepository
{
    use PermissionTrait;
    public function __construct(
        private Resume $resume
    )
    {
    }

    public function make(string $id): bool
    {
        $this->resume = Resume::find($id);
        $this->checkPermission(Auth::user(), 'delete', $this->resume);
        $this->resume->delete();
        return true;
    }
}
