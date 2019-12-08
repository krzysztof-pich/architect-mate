<?php

namespace Pich\App\Tests\Response;

use Pich\App\Response\Json;
use PHPUnit\Framework\TestCase;
use Phake as p;

class JsonTest extends TestCase
{
    public function testRender()
    {
        $data = ['test' => 1];
        $jsonResponse = new Json();
        $jsonResponse->setData($data);
        $this->assertEquals(json_encode($data), $jsonResponse->render());
        $this->assertEquals(
            [
                'Access-Control-Allow-Origin: *',
                'Content-Type: application/json; charset=UTF-8',
            ],
            $jsonResponse->getHeaders()
        );
    }
}
