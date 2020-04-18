<?php

namespace Pich\App\Tests;

use PHPUnit\Framework\TestCase;
use Phake as p;
use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\Router\Dispatcher;
use Pich\App\WebKernel;

class WebKernelTest extends TestCase
{
    public function testWebKernel()
    {
        $responseInterface = p::mock(ResponseInterface::class);
        $dispatcher = p::mock(Dispatcher::class);
        p::when($dispatcher)->dispatch()->thenReturn($responseInterface);
        $kernel = new WebKernel($dispatcher);
        $kernel->execute();

        p::verify($dispatcher)->dispatch();
    }
}
