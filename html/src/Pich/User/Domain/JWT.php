<?php declare(strict_types=1);

namespace Pich\User\Domain;

use Firebase\JWT\JWT as JWTLib;
use Pich\User\Domain\DTO\User;

class JWT
{
    private string $secretKey;

    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function encodeUser(User $user): string
    {
        $payload = [
            'iss' => 'http://localhost.docker',
            'aud' => 'http://localhost.docker',
            'user_email' => $user->getEmail(),
            'user_id' => $user->getId()
        ];

        return JWTLib::encode($payload, $this->secretKey, 'HS256');
    }

    public function decodeToken(string $token): User
    {
        $decoded = JWTLib::decode($token, $this->secretKey, array('HS256'));
        $user = new User();
        $user->setId($decoded->user_id);
        $user->setEmail($decoded->user_email);
        return $user;
    }
}
