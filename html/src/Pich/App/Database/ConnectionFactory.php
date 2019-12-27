<?php declare(strict_types=1);

namespace Pich\App\Database;

use PDO;

class ConnectionFactory
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
