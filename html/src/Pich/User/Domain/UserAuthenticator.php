<?php declare(strict_types=1);

namespace Pich\User\Domain;

use Pich\App\PasswordHash;
use Pich\App\PayloadDTO;

class UserAuthenticator
{
    private UserRepository $userRepository;
    private PasswordHash $passwordHash;
    private Jwt $jwt;

    public function __construct(UserRepository $userRepository, PasswordHash $passwordHash, Jwt $jwt)
    {
        $this->userRepository = $userRepository;
        $this->passwordHash = $passwordHash;
        $this->jwt = $jwt;
    }

    public function authorize(string $email, string $password): PayloadDTO
    {
        $payload = new PayloadDTO();
        $user = $this->userRepository->findUserByEmail($email);
        if ($this->passwordHash->verifyPassword($password, $user->getPassword())) {
            $payload->setData(['jwt' => $this->jwt->encodeUser($user)]);
        }

        return $payload;
    }
}
