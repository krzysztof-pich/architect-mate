<?php
declare(strict_types=1);

namespace Pich\Main\Tests\Controller;

use Pich\Main\Controller\Index;

class IndexTest extends \PHPUnit\Framework\TestCase
{

    public function testMainController()
    {
        $indexController = new Index();
        $this->assertInstanceOf(Index::class, $indexController);
    }
}
