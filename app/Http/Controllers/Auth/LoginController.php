<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\Login\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Services\Login\Action\LoginAction;
use App\Services\Login\Dto\LoginUserDto;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/login",
     *     summary="Login user",
     *     tags={"Authentication"},
     *     description="Logs in a user using the provided credentials.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="login", type="string", description="User login identifier"),
     *             @OA\Property(property="password", type="string", description="User password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *     )
     * )
     */

    public function __invoke(
        LoginRequest $request,
        LoginAction $loginAction
    ): AuthResource {
        $dto = LoginUserDto::fromRequest($request);

        $data = $loginAction->run($dto);

        return new AuthResource($data);
    }
}
