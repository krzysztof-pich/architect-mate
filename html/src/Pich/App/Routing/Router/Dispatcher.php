<?php declare(strict_types=1);

namespace Pich\App\Routing\Router;

use Exception;
use FastRoute\RouteCollector;
use Pich\App\Action\ActionInterface;
use Pich\App\Response\JsonNotFound;
use Pich\App\Response\JsonOptions;
use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\Request;
use function FastRoute\simpleDispatcher;

class Dispatcher
{
    /**
     * @var RouteInterface[]
     */
    private array $routes = [];
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function addRoute(RouteInterface $route): void
    {
        $this->routes[] = $route;
    }

    /**
     * @throws Exception
     */
    public function dispatch(): ResponseInterface
    {
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            return new JsonOptions();
        }

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
                $this->request->setRouteParams((array)$route[2]);
                return $action->execute($this->request);
                break;
            default:
                return new JsonNotFound();
                break;
        }
    }
}
