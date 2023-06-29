<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Services\SignService;
use Illuminate\Http\JsonResponse;

class SignController extends BaseController
{
    /**
     * Login api
     * @param App\Http\Requests\SignInRequest $request
     * @param App\Services\SignService $service
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function login(SignInRequest $request, SignService $service): JsonResponse
    {
        if(!$user = $service->signIn($request->validated()))
        {
            return $this->error(__("Неверный логин или пароль"));
        }
        return $this->success($user);
    }
}
