<?php declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contracts\AuthRequestInterface;
use App\UseCases\Admin\AuthUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        private AuthUseCase $useCase,
    )
    {
    }

    public function __invoke(AuthRequestInterface $request): RedirectResponse
    {
        $requestDTO = $request->getValidated();

        $response = $this->useCase->execute($requestDTO);

        if($response) {
            $request->session()->regenerate();
            return redirect('/pulse');
        }

        return redirect('/pulse/auth');
    }
}
