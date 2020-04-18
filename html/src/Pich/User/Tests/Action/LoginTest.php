<?php

namespace Pich\User\Tests\Action;

use Phake_IMock;
use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\RequestInterface;
use Phake as p;
use Pich\App\TestsUtils\ResponderTestCase;
use Pich\User\Action\Login;
use Pich\User\Domain\UserAuthenticator;
use Pich\User\Responder\JwtResponder;


class LoginTest extends ResponderTestCase
{
    /**
     * @var RequestInterface|Phake_IMock
     */
    private $request;
    /**
     * @var UserAuthenticator|Phake_IMock
     */
    private $domain;
    /**
     * @var JwtResponder|Phake_IMock
     */
    private $responder;

    public function setUp(): void
    {
        parent::setUp();
        [$this->request, $this->domain, $this->responder] = $this->createDomainResponderMock(
            UserAuthenticator::class,
            JwtResponder::class
        );
    }

    public function testExecute(): void
    {
        $payload = $this->createTestPayload();
        $email = 'test@pich.pl';
        $password = 'qwerty';

        p::when($this->domain)->authorize($email, $password)->thenReturn($payload);
        p::when($this->request)->getParam('email')->thenReturn($email);
        p::when($this->request)->getParam('password')->thenReturn($password);

        $controller = new Login($this->domain, $this->responder);
        $controller->execute($this->request);

        p::verify($this->domain)->authorize($email, $password);
        p::verify($this->responder)->setPayload($payload);
        p::verify($this->responder)->send();
    }
}
