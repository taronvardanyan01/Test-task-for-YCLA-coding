<?php

namespace App\Repositories\Read\Users;

use App\Models\User;

interface UserReadRepositoryInterface
{
    public function getByEmail(string $email): User;
    public function getByPhone(string $phone): User;
}
