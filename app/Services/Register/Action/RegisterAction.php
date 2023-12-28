<?php

namespace App\Services\Register\Action;

use App\Http\Controllers\Auth\UseCase\GetPassportTokenUseCase;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use App\Services\Register\Dto\RegisterDto;
use App\Models\User;

class RegisterAction
{
    private User $user;

    public function __construct(
        private UserWriteRepositoryInterface $userWriteRepository,
        private GetPassportTokenUseCase $getPassportTokenUseCase
    ) {}

    public function run(RegisterDto $dto): array
    {
        $this->userCreate($dto);

        return $this->getPassportTokenUseCase->run($this->user->email, $dto->password);
    }

    private function userCreate(RegisterDto $dto): void
    {
        $this->user = User::staticCreate($dto);
        $this->userWriteRepository->save($this->user);
    }
}
