<?php declare(strict_types=1);

namespace App\Traits;

use App\Models\User;
use App\Models\UserEmployer;
use Illuminate\Auth\Access\AuthorizationException;

trait PermissionTrait
{
    public function checkPermission(User|UserEmployer $user, string $permission, $model = null)
    {
        if($user->cannot($permission, $model)) {
            throw new AuthorizationException();
        }
    }
}
