<?php declare(strict_types=1);

namespace Pich\Repository\Action;

use Pich\App\Action\ActionInterface;
use Pich\App\JsonResponder;
use Pich\App\Response\ResponseInterface;

class Add implements ActionInterface
{
    /**
     * @var JsonResponder
     */
    private $responder;

    public function __construct(JsonResponder $responder)
    {
        $this->responder = $responder;
    }

    public function execute(array $request): ResponseInterface
    {
        return $this->responder->send(
            [
                'name'        => 'test 1',
                'destination' => '/tmp/repo1',
                'description' => 'test test repository 1 description',
                'type'        => 'git',
            ]
        );
    }
}
