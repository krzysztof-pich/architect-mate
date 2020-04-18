<?php

namespace Pich\User\Tests\Domain;

use PDO;
use PDOStatement;
use Phake_IMock;
use Pich\App\Database\ConnectionFactory;
use Pich\User\Domain\DTO\User;
use Pich\User\Domain\UserRepository;
use PHPUnit\Framework\TestCase;
use Phake as p;

class UserRepositoryTest extends TestCase
{
    /**
     * @var ConnectionFactory|Phake_IMock
     */
    private $connectionFactory;
    /**
     * @var PDO|Phake_IMock
     */
    private $connection;
    /**
     * @var PDOStatement|Phake_IMock
     */
    private $stmt;

    public function setUp(): void
    {
        $this->connectionFactory = p::mock(ConnectionFactory::class);
        $this->connection = p::mock(PDO::class);
        $this->stmt = p::mock(PDOStatement::class);
        p::when($this->connectionFactory)->getConnection()->thenReturn($this->connection);
        p::when($this->connection)->prepare(p::anyParameters())->thenReturn($this->stmt);

    }

    public function testAddUser(): void
    {
        $email = 'test@pich.pl';
        $password = 'hashedpassword';

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);

        p::when($this->connection)->lastInsertId()->thenReturn(1);
        p::when($this->stmt)->execute(p::anyParameters())->thenReturn(true);

        $repository = new UserRepository($this->connectionFactory);
        $createdUser = $repository->addUser($user);

        $this->assertEquals(1, $createdUser->getId());
        $this->assertEquals($email, $createdUser->getEmail());
        $this->assertEquals($password, $createdUser->getPassword());
        p::verify($this->connection)->prepare('INSERT INTO users (email, password) VALUES(?,?)');
        P::verify($this->stmt)->execute([$email, $password]);
    }

    public function testFindUserByEmail(): void
    {
        p::when($this->stmt)->execute(p::anyParameters())->thenReturn(true);
        p::when($this->stmt)->fetch(PDO::FETCH_ASSOC)->thenReturn(
            [
                'id' => 1,
                'email' => 'test@pich.pl',
                'password' => 'password_hash',
            ]
        );

        $repository = new UserRepository($this->connectionFactory);
        $user = $repository->findUserByEmail('test@pich.pl');
        $this->assertEquals(1, $user->getId());
        $this->assertEquals('test@pich.pl', $user->getEmail());
        $this->assertEquals('password_hash', $user->getPassword());
    }

    public function testUserNotExits(): void
    {
        p::when($this->stmt)->execute(p::anyParameters())->thenReturn(true);
        p::when($this->stmt)->fetch(PDO::FETCH_ASSOC)->thenReturn(false);

        $repository = new UserRepository($this->connectionFactory);
        $this->assertNull($repository->findUserByEmail('no-found@pich.pl'));
    }
}
