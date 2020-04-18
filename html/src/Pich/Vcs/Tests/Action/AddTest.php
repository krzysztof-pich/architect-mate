<?php

namespace Pich\Vcs\Tests\Action;

use Pich\App\JsonResponder;
use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\RequestInterface;
use Pich\Vcs\Action\Add;
use PHPUnit\Framework\TestCase;
use Phake as p;

class AddTest extends TestCase
{
    public function testAddAction()
    {
        // @todo change tests after remove mock
        $response = p::mock(ResponseInterface::class);
        $responder = p::mock(JsonResponder::class);
        $request = p::mock(RequestInterface::class);
        p::when($responder)->send(p::anyParameters())->thenReturn($response);
        $indexAction = new Add($responder);
        $indexAction->execute($request);

        p::verify($responder)->send(p::anyParameters());
    }
}
