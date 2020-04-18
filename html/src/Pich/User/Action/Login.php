<?php declare(strict_types=1);

namespace Pich\User\Action;

use Pich\App\Action\ActionInterface;
use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\RequestInterface;
use Pich\User\Domain\UserRepository;

class Login implements ActionInterface
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(RequestInterface $request): ResponseInterface
    {
        print_r($this->userRepository->findUserByEmail('facesbook@pich.pl'));

        echo 'jest';exit;
    }
}
