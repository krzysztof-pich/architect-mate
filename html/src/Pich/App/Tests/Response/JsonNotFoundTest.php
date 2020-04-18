<?php

namespace Pich\App\Tests\Response;

use Pich\App\Response\JsonNotFound;
use PHPUnit\Framework\TestCase;

class JsonNotFoundTest extends TestCase
{
    public function testNotFoundResponse(): void
    {
        $jsonResponse = new JsonNotFound();
        $this->assertEquals('', $jsonResponse->render());
        $this->assertEquals(
            [
                'Access-Control-Allow-Origin: *',
                'Content-Type: application/json; charset=UTF-8',
            ],
            $jsonResponse->getHeaders()
        );
        $this->assertEquals(404, $jsonResponse->getStatus());
    }
}
