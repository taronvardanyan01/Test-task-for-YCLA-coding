<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\Register\RegisterRequest;
use App\Services\Register\Action\RegisterAction;
use App\Services\Register\Dto\RegisterDto;
use App\Http\Resources\AuthResource;
use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="Test swagger",
 *     version="1.0.0",
 * ),
 * @OA\Server(
 *     description="Test swagger",
 *     url="http://127.0.0.1:8000/api"
 * ),
 * @OA\SecurityScheme(
 *      securityScheme="Authorization Token",
 *      type="apiKey",
 *      in="header",
 *      name="Authorization",
 *  )
 */

class RegisterController extends Controller
{
    /**
     * @OA\Post(
     *     path="/register",
     *     summary="Register a new user",
     *     tags={"Authentication"},
     *          @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="lastName", type="string"),
     *              @OA\Property(property="patronymic", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              @OA\Property(property="password_confirmation", type="string")
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful registration",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *     ),
     * )
     */

    public function __invoke(
        RegisterRequest $request,
        RegisterAction $registerAction
    ): AuthResource {
        $dto = RegisterDto::fromRequest($request);

        $data = $registerAction->run($dto);

        return new AuthResource($data);
    }
}
