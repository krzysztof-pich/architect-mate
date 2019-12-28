<?php declare(strict_types=1);

namespace Pich\User\Action;

use Pich\App\Action\ActionInterface;
use Pich\App\JsonResponder;
use Pich\App\Response\ResponseInterface;

class Register implements ActionInterface
{
    private JsonResponder $jsonResponder;

    public function __construct(JsonResponder $jsonResponder)
    {
        $this->jsonResponder = $jsonResponder;
    }

    public function execute(array $request): ResponseInterface
    {
        return $this->jsonResponder->send([]);
    }
}
