<?php

namespace Pich\App\Tests;

use Pich\App\Database\ConnectionFactory;
use PHPUnit\Framework\TestCase;
use Phake as p;

class ConnectionFactoryTest extends TestCase
{

    public function testGetConnection()
    {
        $pdo = p::mock(\PDO::class);
        $database = new ConnectionFactory($pdo);

        $this->assertInstanceOf(\PDO::class, $database->getConnection());
    }
}
