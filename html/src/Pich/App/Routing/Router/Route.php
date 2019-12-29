<?php declare(strict_types=1);

namespace Pich\App\Routing\Router;

use InvalidArgumentException;
use Pich\App\Action\ActionInterface;

class Route implements RouteInterface
{
    private string $method;
    private string $path;
    private ActionInterface $controller;

    public function __construct(string $method, string $path, ActionInterface $controller)
    {
        if (!in_array($method, ['POST', 'GET'])) {
            throw new InvalidArgumentException('Invalid method in route: ' . $method);
        }

        $this->method = $method;
        $this->path = $path;
        $this->controller = $controller;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getController(): ActionInterface
    {
        return $this->controller;
    }
}
