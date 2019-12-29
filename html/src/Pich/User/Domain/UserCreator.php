<?php declare(strict_types=1);

namespace Pich\User\Domain;

use Pich\App\PayloadDTO;
use Pich\User\Domain\DTO\User;

class UserCreator
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(string $email, string $password): PayloadDTO
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $payload = new PayloadDTO();

        try {
            $this->userRepository->addUser($user);
            $payload->setData(['user' => $user]);
        } catch (\PDOException $exception) {
            if ((int)$exception->getCode() === 23000) {
                $payload->setStatus(PayloadDTO::DUPLICATED_ENTRY);
                $payload->setStatusMessage("Email {$email} already exists");
            } else {
                $payload->setStatus(PayloadDTO::INTERNAL_ERROR);
                $payload->setStatusMessage('User can\'t be registered');
            }
        }

        return $payload;
    }
}
