<?php declare(strict_types=1);
namespace App\Repositories\UserEmployer;

use App\DTO\UserEmployer\UpdateRequestDTO;
use App\DTO\UserEmployer\UserEmployerDTO;
use App\Models\UserEmployer;
use App\Repositories\UserEmployer\Exceptions\InvalidPasswordException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateRepository
{
    public function __construct(
        private UserEmployer $userEmployer
    )
    {
    }

    public function make(UpdateRequestDTO $requestDTO): UserEmployerDTO
    {
        $this->userEmployer = Auth::user();

        DB::transaction( function () use($requestDTO) {
            $this->changePassword($requestDTO->password, $requestDTO->new_password);
            $this->userEmployer->update($requestDTO->toArray());
        });

        return new UserEmployerDTO(
            $this->userEmployer
        );
    }

    private function changePassword(string|null $password, string|null $new_password)
    {
        if(isset($password) && isset($new_password)) {
            if(Hash::check($password, $this->userEmployer->password)) {
                $this->userEmployer->password = $new_password;
                $this->userEmployer->save();
            } else {
                throw new InvalidPasswordException();
            }
        }
    }
}
