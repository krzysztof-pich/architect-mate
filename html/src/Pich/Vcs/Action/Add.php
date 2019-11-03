<?php declare(strict_types=1);

namespace Pich\Vcs\Action;

use Pich\App\Action\ActionInterface;
use Pich\App\Response\ResponseInterface;
use Pich\Vcs\Responder\AddResponder;

class Add implements ActionInterface
{
    /**
     * @var AddResponder
     */
    private $responder;

    public function __construct(AddResponder $responder)
    {
        $this->responder = $responder;
    }

    public function execute(array $request): ResponseInterface
    {
        return $this->responder->send();
    }
}
