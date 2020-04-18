<?php declare(strict_types=1);

namespace Pich\User\Action;

use Pich\App\Action\ActionInterface;
use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\RequestInterface;
use Pich\User\Domain\UserAuthenticator;
use Pich\User\Responder\JwtResponder;

class Login implements ActionInterface
{
    private UserAuthenticator $userAuthenticator;
    private JwtResponder $responder;

    public function __construct(UserAuthenticator $userAuthenticator, JwtResponder $responder)
    {
        $this->userAuthenticator = $userAuthenticator;
        $this->responder = $responder;
    }

    public function execute(RequestInterface $request): ResponseInterface
    {
        echo 'jest';exit;
        $payload = $this->userAuthenticator->authorize(
            (string)$request->getParam('email'),
            (string)$request->getParam('password')
        );

        $this->responder->setPayload($payload);
        return $this->responder->send();
    }
}
