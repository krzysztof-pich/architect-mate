<?php

namespace Pich\User\Tests\Action;

use Phake_IMock;
use Pich\App\PayloadDTO;
use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\RequestInterface;
use Pich\User\Action\Register;
use PHPUnit\Framework\TestCase;
use Phake as p;
use Pich\User\Domain\UserCreator;
use Pich\User\Responder\UserResponder;

class RegisterTest extends TestCase
{
    /**
     * @var UserResponder|Phake_IMock
     */
    private $userResponder;
    /**
     * @var UserCreator|Phake_IMock
     */
    private $userCreator;
    /**
     * @var RequestInterface|Phake_IMock
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->userResponder = p::mock(UserResponder::class);
        p::when($this->userResponder)->send()->thenReturn(p::mock(ResponseInterface::class));
        $this->userCreator = p::mock(UserCreator::class);
        $this->request = p::mock(RequestInterface::class);
    }

    public function testExecute()
    {
        $email = 'test@pich.pl';
        $password = 'qwerty';
        $payload = new PayloadDTO();
        $payload->setData(['test' => 'test']);

        p::when($this->userCreator)->createUser(p::anyParameters())->thenReturn($payload);
        p::when($this->request)->getParam('email')->thenReturn($email);
        p::when($this->request)->getParam('password')->thenReturn($password);

        $register = new Register($this->userCreator, $this->userResponder);
        $register->execute($this->request);

        p::verify($this->userCreator)->createUser($email, $password);
        p::verify($this->userResponder)->setPayload($payload);
        p::verify($this->userResponder)->send();
    }
}
