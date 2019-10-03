<?php

namespace Pich\Main\Tests\Responder;

use Pich\App\Response\Http;
use Pich\Main\Responder\IndexResponder;
use PHPUnit\Framework\TestCase;
use Phake as p;

class IndexResponderTest extends TestCase
{

    public function testSend()
    {
        $http = p::mock(Http::class);

        $responder = new IndexResponder($http);
        $responder->send();

        p::verify($http)->setTemplate('Main/Views/index.twig');
    }
}
