<?php declare(strict_types=1);

namespace Pich\App;

class Database
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getConnection(): \PDO
    {
        return $this->pdo;
    }
}
