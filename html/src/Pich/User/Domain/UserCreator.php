<?php declare(strict_types=1);

namespace Pich\User\Domain;

use Pich\User\Domain\DTO\User;

class UserCreator
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(string $email, string $password): User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        $this->userRepository->addUser($user);

        return $user;
    }
}
