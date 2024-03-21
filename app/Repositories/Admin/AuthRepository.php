<?php declare(strict_types=1);
namespace App\Repositories\Admin;

use App\DTO\Admin\AuthRequestDTO;
use App\Repositories\Admin\Exceptions\InvalidCredentialsException;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function make(AuthRequestDTO $requestDTO): bool
    {
        $auth = Auth::guard('admin')
            ->attempt([
                'login' => $requestDTO->login,
                'password' => $requestDTO->password
            ]);
        if($auth) {
            return true;
        } else {
            throw new InvalidCredentialsException();
        }
    }
}
