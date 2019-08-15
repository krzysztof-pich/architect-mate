<?php

namespace Pich\App;

use PHPUnit\Framework\TestCase;
use Phake as p;
use Pich\App\Router\Dispatcher;

class WebKernelTest extends TestCase
{
    public function testWebKernel()
    {
        $dispatcher = p::mock(Dispatcher::class);
        $kernel = new WebKernel($dispatcher);
        $kernel->execute();

        p::verify($dispatcher)->dispatch();
    }
}
