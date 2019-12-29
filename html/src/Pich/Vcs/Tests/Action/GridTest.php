<?php

namespace Pich\Vcs\Tests\Action;

use PHPUnit\Framework\TestCase;
use Pich\App\JsonResponder;
use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\RequestInterface;
use Pich\Vcs\Action\Grid;
use Phake as p;

class GridTest extends TestCase
{
    public function testGridAction()
    {
        // @todo change tests after remove mock
        $request = p::mock(RequestInterface::class);
        $response = p::mock(ResponseInterface::class);
        $responder = p::mock(JsonResponder::class);
        p::when($responder)->send(p::anyParameters())->thenReturn($response);
        $indexAction = new Grid($responder);
        $indexAction->execute($request);

        p::verify($responder)->send(p::anyParameters());
    }
}
