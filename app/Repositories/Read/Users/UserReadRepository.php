<?php

namespace App\Repositories\Read\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class UserReadRepository implements UserReadRepositoryInterface
{
    private function query(): Builder
    {
        return User::query();
    }

    public function getByEmail(string $email): User
    {
        $user = $this->query()->where('email', $email)->first();

        if (is_null($user)) {
            throw new NotFoundResourceException('User with email ' . $email . ' not found');
        }

        return $user;
    }

    public function getByPhone(string $phone): User
    {
        $user = $this->query()->where('phone', $phone)->first();

        if (is_null($user)) {
            throw new NotFoundResourceException('User with phone ' . $phone . ' not found');
        }

        return $user;
    }
}
