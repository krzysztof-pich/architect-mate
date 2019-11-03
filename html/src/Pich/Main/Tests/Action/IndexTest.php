<?php declare(strict_types=1);

namespace Pich\Main\Tests\Action;

use Pich\App\Response\ResponseInterface;
use Pich\Main\Action\Index;
use Phake as p;
use Pich\Main\Responder\IndexResponder;

class IndexTest extends \PHPUnit\Framework\TestCase
{

    public function testMainController()
    {
        $response = p::mock(ResponseInterface::class);
        $responder = p::mock(IndexResponder::class);
        p::when($responder)->send()->thenReturn($response);
        $indexAction = new Index($responder);
        $indexAction->execute([]);

        p::verify($responder)->send();
    }
}
