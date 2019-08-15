<?php declare(strict_types=1);

namespace Pich\App\Router;

use Phake as p;
use PHPUnit\Framework\TestCase;
use Pich\App\Controller\ControllerInterface;
use Psr\Container\ContainerInterface;

class DispatcherTest extends TestCase
{
    private $container;

    public function setUp(): void
    {
        $this->container = p::mock(ContainerInterface::class);
    }

    public function testDispatch()
    {
        $controller = p::mock(ControllerInterface::class);
        $route = new Route('GET', '/', $controller);

        p::when($this->container)->get(p::anyParameters())->thenReturn($controller);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/';

        $dispatcher = new Dispatcher($this->container);
        $dispatcher->addRoute($route);
        $dispatcher->dispatch();

        p::verify($controller)->execute([]);
    }

    public function testParameters()
    {
        $controller = p::mock(ControllerInterface::class);
        $route = new Route('GET', '/user/{user_id:\d+}', $controller);

        p::when($this->container)->get(p::anyParameters())->thenReturn($controller);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/user/32';

        $dispatcher = new Dispatcher($this->container);
        $dispatcher->addRoute($route);
        $dispatcher->dispatch();

        p::verify($controller)->execute(['user_id' => 32]);
    }
}
