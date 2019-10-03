<?php

namespace Pich\App\Tests\Response;

use Pich\App\Response\Http;
use PHPUnit\Framework\TestCase;
use Phake as p;

class HttpTest extends TestCase
{

    public function testRender()
    {
        $twig = p::mock(\Twig_Environment::class);
        p::when($twig)->render('Module/Views/index.twig', ['test' => 'test'])->thenReturn('response');
        $http = new Http($twig);
        $http->setTemplate('Module/Views/index.twig');
        $http->setData(['test' => 'test']);
        $response = $http->render();

        $this->assertEquals('response', $response);
    }
}
