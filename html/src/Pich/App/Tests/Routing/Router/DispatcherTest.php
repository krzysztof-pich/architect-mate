<?php declare(strict_types=1);

namespace Pich\App\Tests\Routing\Router;

use Phake as p;
use PHPUnit\Framework\TestCase;
use Pich\App\Action\ActionInterface;
use Pich\App\Response\JsonOptions;
use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\Router\Dispatcher;
use Pich\App\Routing\Router\Route;

class DispatcherTest extends TestCase
{
    private $container;

    public function setUp(): void
    {
    }

    public function testDispatch()
    {
        $action = p::mock(ActionInterface::class);
        $response = p::mock(ResponseInterface::class);
        p::when($action)->execute(p::anyParameters())->thenReturn($response);
        p::when($response)->render()->thenReturn('test');
        $route = new Route('GET', '/', $action);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/';

        $dispatcher = new Dispatcher();
        $dispatcher->addRoute($route);
        $result = $dispatcher->dispatch();

        $this->assertInstanceOf(ResponseInterface::class, $result);
    }

    public function testParameters()
    {
        $action = p::mock(ActionInterface::class);
        $response = p::mock(ResponseInterface::class);
        p::when($action)->execute(p::anyParameters())->thenReturn($response);
        p::when($response)->render()->thenReturn('test');
        $route = new Route('GET', '/user/{user_id:\d+}', $action);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/user/32';

        $dispatcher = new Dispatcher();
        $dispatcher->addRoute($route);
        $result = $dispatcher->dispatch();

        $this->assertInstanceOf(ResponseInterface::class, $result);
    }

    public function testNotFound()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Not Found');

        $action = p::mock(ActionInterface::class);
        $route = new Route('GET', '/', $action);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/not-found-route';

        $dispatcher = new Dispatcher();
        $dispatcher->addRoute($route);
        $dispatcher->dispatch();
    }

    public function testOptions()
    {
        $_SERVER['REQUEST_METHOD'] = 'OPTIONS';
        $dispatcher = new Dispatcher();
        $result = $dispatcher->dispatch();
        $this->assertInstanceOf(JsonOptions::class, $result);
    }
}
