<?php declare(strict_types=1);

namespace Pich\User\Domain;

use PDO;
use PDOException;
use Pich\App\Database\ConnectionFactory;
use Pich\User\Domain\DTO\User as UserDto;

class UserRepository
{
    private PDO $connection;

    public function __construct(ConnectionFactory $connection)
    {
        $this->connection = $connection->getConnection();
    }

    /**
     * @param UserDto $user
     * @return UserDto
     * @throws PDOException
     */
    public function addUser(UserDto $user): UserDto
    {
        $stmt = $this->connection->prepare('INSERT INTO users (email, password) VALUES(?,?)');
        $stmt->execute([$user->getEmail(), $user->getPassword()]);
        $user->setId((int)$this->connection->lastInsertId());

        return $user;
    }

    /**
     * @param string $email
     * @return UserDto
     * @throws PDOException
     */
    public function findUserByEmail(string $email): ?UserDto
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE email=? LIMIT 1');
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return null;
        }
        $user = new UserDto();
        $user
            ->setId((int)$result['id'])
            ->setEmail($result['email'])
            ->setPassword($result['password']);
        return $user;
    }
}
