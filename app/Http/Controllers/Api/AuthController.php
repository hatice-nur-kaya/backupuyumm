<?php

namespace App\Http\Controllers\Api;

use App\Core\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthController\LoginRequest;
use App\Interfaces\IUserService;

class AuthController extends Controller
{
    use HttpResponse;

    protected IUserService $userService;
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }


    public function login(LoginRequest $request){

        $response = $this->userService->login(
            $request->email,
            $request->password
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode(),
        );
    }
}
