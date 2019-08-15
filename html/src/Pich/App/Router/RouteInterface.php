<?php declare(strict_types=1);

namespace Pich\App\Router;

use Pich\App\Controller\ControllerInterface;

interface RouteInterface
{
    public function getMethod(): string;
    public function getPath(): string;
    public function getController(): ControllerInterface;
}
