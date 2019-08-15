<?php declare(strict_types=1);

namespace Pich\App\Router;

use Pich\App\Controller\ControllerInterface;

class Route implements RouteInterface
{
    /**
     * @var string
     */
    private $method;
    /**
     * @var string
     */
    private $path;
    /**
     * @var ControllerInterface
     */
    private $controller;

    public function __construct(string $method, string $path, ControllerInterface $controller)
    {
        if (!in_array($method, ['POST', 'GET'])) {
            throw new \InvalidArgumentException('Invalid method in route: ' . $method);
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

    public function getController(): ControllerInterface
    {
        return $this->controller;
    }
}
