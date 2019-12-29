<?php declare(strict_types=1);

namespace Pich\App\Tests\Routing\Router;

use PHPUnit\Framework\TestCase;
use Phake as p;
use Pich\App\Action\ActionInterface;
use Pich\App\Routing\Router\Route;

class RouteTest extends TestCase
{
    public function testRoute()
    {
        $controller = p::mock(ActionInterface::class);
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

        $controller = p::mock(ActionInterface::class);
        new Route('invalid_method_name', '/', $controller);
    }
}
