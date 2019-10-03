<?php declare(strict_types=1);

namespace Pich\App;

use Pich\App\Router\Dispatcher;

class WebKernel
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function execute()
    {
        $response = $this->dispatcher->dispatch();
        echo $response;
    }
}
