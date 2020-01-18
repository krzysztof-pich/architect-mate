<?php

namespace Pich\User\Tests\Domain;

use PHPUnit\Framework\TestCase;
use Pich\User\Domain\DTO\User;
use Pich\User\Domain\JWT;

class JWTTest extends TestCase
{
    public function testEncodeAndDecodeMethods(): void
    {
        $userId = 3;
        $userEmail = 'test@pich.pl';

        $user = new User();
        $user->setId($userId);
        $user->setEmail($userEmail);

        $jwt = new JWT('test_secret');
        $token = $jwt->encodeUser($user);
        $decodedUser = $jwt->decodeToken($token);

        $this->assertEquals($decodedUser->getId(), $userId, 'Encode user have different id');
        $this->assertEquals($decodedUser->getEmail(), $userEmail, 'Encode user have different email');
    }
}
