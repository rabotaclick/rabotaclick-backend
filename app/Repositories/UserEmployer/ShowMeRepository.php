<?php declare(strict_types=1);
namespace App\Repositories\UserEmployer;

use App\DTO\UserEmployer\UserEmployerDTO;
use App\Models\UserEmployer;
use Illuminate\Support\Facades\Auth;

class ShowMeRepository
{
    public function __construct(
        private UserEmployer $userEmployer
    )
    {
    }

    public function make(): UserEmployerDTO
    {
        $this->userEmployer = Auth::user();

        return new UserEmployerDTO(
            $this->userEmployer
        );
    }
}
