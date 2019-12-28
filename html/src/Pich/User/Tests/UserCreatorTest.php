<?php

namespace Pich\User\Tests;

use Phake_IMock;
use Pich\User\Domain\DTO\User;
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
        $user = $userCreator->createUser($email, $password);

        p::verify($this->repository)->addUser($user);
        $this->assertEquals($email, $user->getEmail());
        $this->assertTrue(password_verify($password, $user->getPassword()));
    }
}
