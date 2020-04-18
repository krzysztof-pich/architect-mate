<?php declare(strict_types=1);

namespace Pich\User\Action;

use Pich\App\Action\ActionInterface;
use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\RequestInterface;
use Pich\User\Domain\UserCreator;
use Pich\User\Responder\UserResponder;

class Register implements ActionInterface
{
    private UserCreator $userCreator;
    private UserResponder $userResponder;

    public function __construct(UserCreator $userCreator, UserResponder $userResponder)
    {
        $this->userCreator = $userCreator;
        $this->userResponder = $userResponder;
    }

    public function execute(RequestInterface $request): ResponseInterface
    {
        $payload = $this->userCreator->createUser($request->getParam('email'), $request->getParam('password'));
        $this->userResponder->setPayload($payload);
        return $this->userResponder->send();
    }
}
