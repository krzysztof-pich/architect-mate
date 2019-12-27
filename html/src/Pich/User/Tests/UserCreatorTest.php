<?php

namespace Pich\User\Tests;

use Phake_IMock;
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
        $userCreator = new UserCreator();
        $user = $userCreator->createUser($email, $password);

        //todo finish tests
        p::when($this->repository)->addUser($user);

        $this->assertEquals(1, $user->getId());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals('$2y$10$.AtkkZ.LkmpAg61sMKeuSubbjLX.Ayju7TaTd7TUkuiL9kmiTRVmi', $user->getPassword());
    }
}
