<?php declare(strict_types=1);

namespace App\Repositories\Auth\Employer;

use App\DTO\Auth\Employer\FinishRegisterRequestDTO;
use App\DTO\UserEmployer\UserEmployerDTO;
use App\Models\UserEmployer;
use App\Repositories\Auth\Employer\Exceptions\FinishRegisterRepositoryException;
use Illuminate\Support\Facades\Auth;

class FinishRegisterRepository
{
    public function __construct(
        private UserEmployer $userEmployer
    )
    {
    }

    public function make(FinishRegisterRequestDTO $requestDTO): UserEmployerDTO
    {
        $this->userEmployer = Auth::user();

        if(isset($this->userEmployer->name) || isset($this->userEmployer->surname)) {
            throw new FinishRegisterRepositoryException();
        }

        $this->userEmployer->name = $requestDTO->name;
        $this->userEmployer->surname = $requestDTO->surname;
        $this->userEmployer->save();

        return new UserEmployerDTO($this->userEmployer);
    }
}
