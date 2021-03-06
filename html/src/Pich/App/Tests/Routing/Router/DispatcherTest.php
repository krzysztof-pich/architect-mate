<?php declare(strict_types=1);

namespace Pich\App\Tests\Routing\Router;

use Exception;
use Phake as p;
use Phake_IMock;
use PHPUnit\Framework\TestCase;
use Pich\App\Action\ActionInterface;
use Pich\App\Response\JsonNotFound;
use Pich\App\Response\JsonOptions;
use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\Request;
use Pich\App\Routing\Router\Dispatcher;
use Pich\App\Routing\Router\Route;

class DispatcherTest extends TestCase
{
    /**
     * @var Request|Phake_IMock
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = p::mock(Request::class);
    }

    public function testDispatch(): void
    {
        $action = p::mock(ActionInterface::class);
        $response = p::mock(ResponseInterface::class);
        p::when($action)->execute(p::anyParameters())->thenReturn($response);
        p::when($response)->render()->thenReturn('test');
        $route = new Route('GET', '/', $action);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/';

        $dispatcher = new Dispatcher($this->request);
        $dispatcher->addRoute($route);
        $result = $dispatcher->dispatch();

        $this->assertInstanceOf(ResponseInterface::class, $result);
        p::verify($action)->execute($this->request);
        p::verify($this->request)->setRouteParams([]);
    }

    public function testParameters(): void
    {
        $action = p::mock(ActionInterface::class);
        $response = p::mock(ResponseInterface::class);
        p::when($action)->execute(p::anyParameters())->thenReturn($response);
        p::when($response)->render()->thenReturn('test');
        $route = new Route('GET', '/user/{user_id:\d+}', $action);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/user/32';

        $dispatcher = new Dispatcher($this->request);
        $dispatcher->addRoute($route);
        $result = $dispatcher->dispatch();

        $this->assertInstanceOf(ResponseInterface::class, $result);
        p::verify($action)->execute($this->request);
        p::verify($this->request)->setRouteParams(['user_id' => 32]);
    }

    public function testNotFound(): void
    {
        $action = p::mock(ActionInterface::class);
        $route = new Route('GET', '/', $action);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/not-found-route';

        $dispatcher = new Dispatcher($this->request);
        $dispatcher->addRoute($route);
        $result = $dispatcher->dispatch();
        $this->assertInstanceOf(JsonNotFound::class, $result);
    }

    public function testOptions(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'OPTIONS';
        $dispatcher = new Dispatcher($this->request);
        $result = $dispatcher->dispatch();
        $this->assertInstanceOf(JsonOptions::class, $result);
    }
}
