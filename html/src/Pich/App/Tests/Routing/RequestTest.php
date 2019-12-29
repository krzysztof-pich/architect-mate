<?php

namespace Pich\App\Tests\Routing;

use Phake_IMock;
use Pich\App\Routing\Request;
use PHPUnit\Framework\TestCase;
use Phake as p;

class RequestTest extends TestCase
{
    public function testGetParams()
    {
        $request = new Request();
        $request->setRouteParams(['user' => 1, 'name' => 'John Doe']);

        $this->assertEquals(1, $request->getParam('user'));
        $this->assertEquals('John Doe', $request->getParam('name'));
        $this->assertEquals(['user' => 1, 'name' => 'John Doe'], $request->getParams());
    }

    public function testPostParams()
    {
        /** @var Request|Phake_IMock $request */
        $request = p::partialMock(Request::class);
        p::when($request)->getInputStream()->thenReturn('{"email":"test@pich.pl","password":"qwerty"}');

        $this->assertEquals(['email' => 'test@pich.pl', 'password' => 'qwerty'], $request->getPost());
        $this->assertEquals('test@pich.pl', $request->getParam('email'));
        $this->assertEquals('qwerty', $request->getParam('password'));
    }

    public function testGetAndPostWithSameName()
    {
        /** @var Request|Phake_IMock $request */
        $request = p::partialMock(Request::class);
        p::when($request)->getInputStream()->thenReturn('{"email":"test@pich.pl","password":"qwerty"}');
        $request->setRouteParams(['user' => 1, 'email' => 'test2@pich.pl']);

        $this->assertEquals('test2@pich.pl', $request->getParam('email'));
        $this->assertEquals('qwerty', $request->getParam('password'));
        $this->assertEquals(1, $request->getParam('user'));
        $this->assertEquals(['user' => 1, 'email' => 'test2@pich.pl', 'password' => 'qwerty'], $request->getParams());

    }
}
