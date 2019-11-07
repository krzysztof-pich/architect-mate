<?php

namespace Pich\Repository\Tests\Responder;

use Pich\App\Response\Http;
use Pich\App\Response\ResponseInterface;
use Pich\Repository\Responder\AddResponder;
use PHPUnit\Framework\TestCase;
use Phake as p;

class AddResponderTest extends TestCase
{
    public function testSend()
    {
        $http = p::mock(Http::class);

        $responder = new AddResponder($http);
        $this->assertInstanceOf(ResponseInterface::class, $responder->send());

        p::verify($http)->setTemplate('Repository/Views/add.twig');
    }
}
