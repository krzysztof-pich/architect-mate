<?php

namespace Pich\App\Tests;

use Phake_IMock;
use Pich\App\JsonResponder;
use PHPUnit\Framework\TestCase;
use Phake as p;
use Pich\App\Response\Json;

class JsonResponderTest extends TestCase
{
    public function testJsonResponder()
    {
        /** @var Json|Phake_IMock $response */
        $response = p::mock(Json::class);
        $responder = new JsonResponder($response);
        $responder->send(['test' => 1]);

        p::verify($response)->setData(['test' => 1]);
    }
}
