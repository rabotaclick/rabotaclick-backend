<?php declare(strict_types=1);

namespace App\UseCases\Company;

use App\DTO\Company\CompanyDTO;
use App\DTO\Company\UpdatePhotoRequestDTO;
use App\Repositories\Company\Exceptions\CompanyNotCreatedException;
use App\Repositories\Company\UpdatePhotoRepository;
use App\UseCases\Company\Exceptions\UpdatePhotoUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class UpdatePhotoUseCase
{
    public function __construct(
        private UpdatePhotoRepository $repository
    )
    {
    }

    public function execute(UpdatePhotoRequestDTO $requestDTO): CompanyDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (CompanyNotCreatedException $exception) {
            throw new UpdatePhotoUseCasesException('Вы еще не создали компанию', Response::HTTP_BAD_REQUEST, $exception);
        } catch (\Throwable $exception) {
            throw new UpdatePhotoUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
