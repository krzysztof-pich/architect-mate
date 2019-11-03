<?php

namespace Pich\Vcs\Tests\Responder;

use Pich\App\Response\Http;
use Pich\App\Response\ResponseInterface;
use Pich\Vcs\Responder\AddResponder;
use PHPUnit\Framework\TestCase;
use Phake as p;

class AddResponderTest extends TestCase
{
    public function testSend()
    {
        $http = p::mock(Http::class);

        $responder = new AddResponder($http);
        $this->assertInstanceOf(ResponseInterface::class, $responder->send());

        p::verify($http)->setTemplate('Vcs/Views/add.twig');
    }
}
