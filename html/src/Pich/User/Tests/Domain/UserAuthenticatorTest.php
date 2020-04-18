<?php

namespace Pich\User\Tests\Domain;

use Phake_IMock;
use Pich\App\PasswordHash;
use Pich\App\PayloadDTO;
use Pich\User\Domain\DTO\User;
use Pich\User\Domain\Jwt;
use Pich\User\Domain\UserAuthenticator;
use PHPUnit\Framework\TestCase;
use Phake as p;
use Pich\User\Domain\UserRepository;

class UserAuthenticatorTest extends TestCase
{
    /**
     * @var UserRepository|Phake_IMock
     */
    private $userRepository;
    /**
     * @var PasswordHash|Phake_IMock
     */
    private $passwordHash;
    /**
     * @var Jwt|Phake_IMock
     */
    private $jwt;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = p::mock(UserRepository::class);
        $this->passwordHash = p::mock(PasswordHash::class);
        $this->jwt = p::mock(Jwt::class);
    }

    public function testUserAuthenticate(): void
    {
        $token = 'jwt_token_encrypted';
        $email = 'test@pich.pl';
        $password = 'qwerty';
        $passwordHash = 'password_hash';
        $user = $this->createUser($email, $passwordHash);

        p::when($this->userRepository)->findUserByEmail($email)->thenReturn($user);
        p::when($this->passwordHash)->verifyPassword($password, $passwordHash)->thenReturn(true);
        p::when($this->jwt)->encodeUser($user)->thenReturn($token);

        $authenticator = new UserAuthenticator($this->userRepository, $this->passwordHash, $this->jwt);
        $payload = $authenticator->authorize($email, $password);

        $this->assertEquals($token, $payload->getData()['jwt'], 'JWT token not created');
        $this->assertEmpty($payload->getStatusMessage(), 'Status should be empty');
        $this->assertEmpty($payload->getStatus(), 'Status message should be empty');
        p::verify($this->jwt)->encodeUser($user);
    }

    public function testUserNotFound(): void
    {
        $email = 'test@pich.pl';
        $password = 'qwerty';

        p::when($this->userRepository)->findUserByEmail($email)->thenReturn(null);
        $authenticator = new UserAuthenticator($this->userRepository, $this->passwordHash, $this->jwt);
        $payload = $authenticator->authorize($email, $password);

        $this->assertEmpty($payload->getData(), 'Data should be empty on error');
        $this->assertEquals('User or password not valid', $payload->getStatusMessage(), 'User should be notified that there is no account');
        $this->assertEquals(PayloadDTO::NOT_FOUND, $payload->getStatus(), 'Correct status should be set');
        p::verifyNoInteraction($this->jwt);
    }

    public function testUserPasswordNotValid(): void
    {
        $email = 'test@pich.pl';
        $password = 'qwerty';
        $passwordHash = 'password_hash';
        $user = $this->createUser($email, $passwordHash);

        p::when($this->userRepository)->findUserByEmail($email)->thenReturn($user);
        p::when($this->passwordHash)->verifyPassword($password, $passwordHash)->thenReturn(false);

        $authenticator = new UserAuthenticator($this->userRepository, $this->passwordHash, $this->jwt);
        $payload = $authenticator->authorize($email, $password);

        $this->assertEmpty($payload->getData(), 'Data should be empty on error');
        $this->assertEquals('User or password not valid', $payload->getStatusMessage(), 'User should be notified when password is incorrect');
        $this->assertEquals(PayloadDTO::NOT_FOUND, $payload->getStatus(), 'Correct status should be set');
        p::verifyNoInteraction($this->jwt);
    }

    private function createUser(string $email, string $passwordHash): User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($passwordHash);
        return $user;
    }
}
