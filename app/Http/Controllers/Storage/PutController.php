<?php declare(strict_types=1);
namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storage\Contracts\PutRequestInterface;
use App\OpenApi\Parameters\Storage\PutParameters;
use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\Responses\Storage\PutResponse;
use App\Presenters\Storage\UrlsPresenter;
use App\UseCases\Storage\PutUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
#[OpenApi\PathItem]
class PutController extends Controller
{
    public function __construct(
        public PutUseCase $useCase,
        public UrlsPresenter $presenter,
    )
    {
    }
    /**
     * Выгрузить изображения в хранилище
     *
     * Выгрузить изображения в хранилище и получить ссылку.
     */
    #[OpenApi\Operation(tags: ['Storage'] ,method: 'POST')]
    #[OpenApi\Parameters(PutParameters::class)]
    #[OpenApi\Response(PutResponse::class, 200)]
    #[OpenApi\Response(ServiceUnavailableErrorResponse::class, 503)]
    public function __invoke(PutRequestInterface $request): JsonResponse
    {
        $requestDTO = $request->getValidated();

        $responseDTO = $this->useCase->execute($requestDTO);

        return $this->presenter->present($responseDTO);
    }
}
