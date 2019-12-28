<?php declare(strict_types=1);

namespace Pich\User\Domain;

use PDO;
use Pich\App\Database\ConnectionFactory;
use Pich\User\Domain\DTO\User;

class UserRepository
{
    private PDO $connection;

    public function __construct(ConnectionFactory $connection)
    {
        $this->connection = $connection->getConnection();
    }

    /**
     * @param User $user
     * @return User
     * @throws \PDOException
     */
    public function addUser(User $user): User
    {
        $stmt = $this->connection->prepare('INSERT INTO users (email, password) VALUES(?,?)');
        $stmt->execute([$user->getEmail(), $user->getPassword()]);

        $user->setId((int)$this->connection->lastInsertId());

        return $user;
    }
}
