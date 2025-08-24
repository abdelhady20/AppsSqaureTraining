<?php

namespace App\Http\Controllers\Api\Front;

use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use App\Services\Front\User\UserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Front\Auth\{
    RegisterRequest,
    SendCodeRequest,
    VerifyCodeRequest
};

use App\Transformers\Api\Front\Auth\AuthTransformer;

class AuthController extends Controller
{
    public function __construct(private UserService $userService) {
    }

    public function register(RegisterRequest $request)
    {
        $this->userService->register($request->validated());
        return $this->responseApi(__('messages.successfully_register_please_verify'));
    }

    public function sendCode(SendCodeRequest $request)
    {
        try {
        $this->userService->sendCode($request->validated());
            return $this->responseApi(__("messages.reset_code_msg"));
        } catch (ValidationException $e) {
            return $this->responseApi($e->getMessage(), null, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function verify(VerifyCodeRequest $request)
    {
        try {
            $data = $this->userService->verify($request->validated());
            $user = fractal()
                ->item($data['user'])
                ->transformWith(new AuthTransformer())
                ->toArray();
            return $this->responseApi(__("messages.successfully_verified_phone"), $user, 200, ['token' => $data['token']]);
        } catch (ValidationException $e) {
            return $this->responseApi($e->getMessage(), null, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function verifyCode(VerifyCodeRequest $request)
    {
        try {
            $this->userService->verifyCode($request->validated());
            return $this->responseApi(__("messages.correct_code"));
        } catch (ValidationException $e) {
            return $this->responseApi($e->getMessage(), null, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}