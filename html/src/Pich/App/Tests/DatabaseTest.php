<?php

namespace Pich\App\Tests;

use Pich\App\Database;
use PHPUnit\Framework\TestCase;
use Phake as p;

class DatabaseTest extends TestCase
{

    public function testGetConnection()
    {
        $pdo = p::mock(\PDO::class);
        $database = new Database($pdo);

        $this->assertInstanceOf(\PDO::class, $database->getConnection());
    }
}
