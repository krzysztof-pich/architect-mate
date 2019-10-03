<?php declare(strict_types=1);

namespace Pich\App\Router;

use Exception;
use FastRoute\RouteCollector;
use Pich\App\Action\ActionInterface;
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

    /**
     * @return string
     * @throws Exception
     */
    public function dispatch(): string
    {
        $routes = $this->routes;
        $dispatcher = simpleDispatcher(function (RouteCollector $r) use ($routes) {
            foreach ($routes as $route) {
                $r->addRoute($route->getMethod(), $route->getPath(), $route->getController());
            }
        });
        $route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
        switch ($route[0]) {
            case \FastRoute\Dispatcher::FOUND:
                /** @var ActionInterface $action */
                $action = $route[1];
                $parameters = (array)$route[2];
                $response = $action->execute($parameters);
                return $response->render();
                break;
            default:
                throw new Exception('Not Found');
                break;
        }
    }
}
