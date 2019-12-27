<?php declare(strict_types=1);

namespace Pich\User\Domain;

use Pich\User\Domain\DTO\User;

class UserCreator
{
    public function createUser(string $email, string $password): User
    {
        return new User();
    }
}
