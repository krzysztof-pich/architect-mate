<?php

namespace Pich\User\Tests\Action;

use Pich\App\JsonResponder;
use Pich\App\Response\ResponseInterface;
use Pich\User\Action\Register;
use PHPUnit\Framework\TestCase;
use Phake as p;

class RegisterTest extends TestCase
{
    private $jsonResponder;

    public function setUp(): void
    {
        parent::setUp();
        $responseInterface = p::mock(ResponseInterface::class);
        $this->jsonResponder = p::mock(JsonResponder::class);
        p::when($this->jsonResponder)->send(p::anyParameters())->thenReturn($responseInterface);
    }

    public function testExecute()
    {
        $register = new Register($this->jsonResponder);
        $register->execute(['test@pich.pl', 'qwerty']);

//        $this->
    }
}
