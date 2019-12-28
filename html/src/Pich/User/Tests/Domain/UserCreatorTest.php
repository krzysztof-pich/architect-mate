<?php

namespace Pich\User\Tests\Domain;

use Phake_IMock;
use Pich\App\PayloadDTO;
use Pich\User\Domain\UserCreator;
use PHPUnit\Framework\TestCase;
use Phake as p;
use Pich\User\Domain\UserRepository;

class UserCreatorTest extends TestCase
{
    /**
     * @var UserRepository|Phake_IMock
     */
    private $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = p::mock(UserRepository::class);
    }

    public function testCreateUser()
    {
        $email = 'test@pich.pl';
        $password = 'qwerty';

        $userCreator = new UserCreator($this->repository);
        $payload = $userCreator->createUser($email, $password);

        p::verify($this->repository)->addUser(p::capture($user));
        $this->assertEquals($email, $user->getEmail());
        $this->assertTrue(password_verify($password, $user->getPassword()));

        $this->assertEquals($user, $payload->getData()['user']);
        $this->assertEmpty($payload->getStatus());
        $this->assertEmpty($payload->getStatusMessage());
    }

    public function testRepositoryException(): void
    {
        p::when($this->repository)->addUser(p::anyParameters())->thenThrow(new \PDOException());
        $userCreator = new UserCreator($this->repository);
        $payload = $userCreator->createUser('test@pich.pl', 'password_hash');

        $this->assertEquals(PayloadDTO::INTERNAL_ERROR, $payload->getStatus());
        $this->assertEquals('User can\'t be registered', $payload->getStatusMessage());
    }
}
