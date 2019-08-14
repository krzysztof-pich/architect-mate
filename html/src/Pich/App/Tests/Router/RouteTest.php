<?php

namespace Pich\App\Router;

use PHPUnit\Framework\TestCase;
use Phake as p;
use Pich\App\Controller\ControllerInterface;

class RouteTest extends TestCase
{
    public function testRoute()
    {
        $controller = p::mock(ControllerInterface::class);
        $route = new Route('GET', '/', $controller);

        $this->assertEquals('GET', $route->getMethod());
        $this->assertEquals('/', $route->getPath());
        $this->assertEquals($controller, $route->getController());

        $route = new Route('POST', '/', $controller);
        $this->assertEquals('POST', $route->getMethod());
    }

    public function testUnsupportedMethod()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid method in route: invalid_method_name');

        $controller = p::mock(ControllerInterface::class);
        new Route('invalid_method_name', '/', $controller);
    }
}
