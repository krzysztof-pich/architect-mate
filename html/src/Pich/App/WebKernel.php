<?php declare(strict_types=1);

namespace Pich\App;

use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\Router\Dispatcher;

class WebKernel
{

    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function execute(): ResponseInterface
    {
        return $this->dispatcher->dispatch();
    }
}
