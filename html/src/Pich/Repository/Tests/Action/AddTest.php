<?php

namespace Pich\Repository\Tests\Action;

use Pich\App\JsonResponder;
use Pich\App\Response\ResponseInterface;
use Pich\Repository\Action\Add;
use PHPUnit\Framework\TestCase;
use Phake as p;

class AddTest extends TestCase
{
    public function testAddAction()
    {
        $response = p::mock(ResponseInterface::class);
        $responder = p::mock(JsonResponder::class);
        p::when($responder)->send(p::anyParameters())->thenReturn($response);
        $indexAction = new Add($responder);
        $indexAction->execute([]);

        p::verify($responder)->send(p::anyParameters());
    }
}
