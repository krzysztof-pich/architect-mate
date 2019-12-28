<?php

namespace Pich\App\Tests\Response;

use Pich\App\Response\JsonOptions;
use PHPUnit\Framework\TestCase;
use Phake as p;

class JsonOptionsTest extends TestCase
{
    public function testRender(): void
    {
        $jsonResponse = new JsonOptions();
        $this->assertEquals('[]', $jsonResponse->render());
        $this->assertEquals(
            [
                'Access-Control-Allow-Origin: *',
                'Access-Control-Allow-Headers: *',
                'Access-Control-Allow-Credentials: true',
                'Access-Control-Max-Age: 86400',
            ],
            $jsonResponse->getHeaders()
        );
        $this->assertEquals(200, $jsonResponse->getStatus());
    }
}
