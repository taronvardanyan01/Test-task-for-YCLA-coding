<?php

namespace App\Services\Login\Action;

use App\Http\Controllers\Auth\UseCase\GetPassportTokenUseCase;
use App\Repositories\Read\Users\UserReadRepositoryInterface;
use App\Services\Login\Dto\LoginUserDto;
use App\Models\User;

class LoginAction
{
    private User $user;
    private array $result;

    public function __construct(
        private UserReadRepositoryInterface $userReadRepository,
        private GetPassportTokenUseCase $getPassportTokenUseCase
    ) {}

    public function run(LoginUserDto $dto): array
    {
        $this->getUser($dto->login);

        $this->result = $this->getPassportTokenUseCase->run($this->user->email, $dto->password);

        $this->checkResult();

        return $this->result;
    }

    private function getUser(string $login): void
    {
        if (strpos($login, '@')) {
            $this->user = $this->userReadRepository->getByEmail($login);
        } else {
            $this->user = $this->userReadRepository->getByPhone($login);
        }
    }

    private function checkResult(): void
    {
        if (!empty($this->result['error'])) {
            throw new \Exception('Do not authorize with this credentials');
        }
    }
}
