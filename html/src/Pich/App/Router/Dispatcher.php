<?php declare(strict_types=1);

namespace Pich\App\Router;

use FastRoute\RouteCollector;
use Psr\Container\ContainerInterface;
use function FastRoute\simpleDispatcher;

class Dispatcher
{
    /**
     * @var RouteInterface[]
     */
    private $routes = [];

    public function addRoute(RouteInterface $route): void
    {
        $this->routes[] = $route;
    }

    public function dispatch()
    {
        $routes = $this->routes;
        $dispatcher = simpleDispatcher(function (RouteCollector $r) use ($routes) {
            foreach ($routes as $route) {
                $r->addRoute($route->getMethod(), $route->getPath(), $route->getController());
            }
        });
        $route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
        switch ($route[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                echo '404 Not Found';
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                echo '405 Method Not Allowed';
                break;
            case \FastRoute\Dispatcher::FOUND:
                $controller = $route[1];
                $parameters = $route[2];
                echo $controller->execute($parameters);
                break;
        }
    }
}
