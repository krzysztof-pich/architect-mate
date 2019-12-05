<?php declare(strict_types=1);

namespace Pich\Repository\Action;

use Pich\App\Action\ActionInterface;
use Pich\App\JsonResponder;
use Pich\App\Response\ResponseInterface;

class Grid implements ActionInterface
{
    /**
     * @var JsonResponder
     */
    private $jsonResponder;

    public function __construct(JsonResponder $jsonResponder)
    {
        $this->jsonResponder = $jsonResponder;
    }

    public function execute(array $request): ResponseInterface
    {
        return $this->jsonResponder->send(
            [
                (object) [
                    'id' => 1,
                    'name' => 'test 1',
                    'destination' => '/tmp/repo1',
                    'description' => 'test test repository 1 description',
                    'type' => 'git',
                ],
                (object) [
                    'id' => 2,
                    'name' => 'test 2',
                    'destination' => '/tmp/repo2',
                    'description' => 'test test repository 2 description',
                    'type' => 'git',
                ],
                (object) [
                    'id' => 3,
                    'name' => 'test 3',
                    'destination' => '/tmp/repo3',
                    'description' => 'test test repository 3 description',
                    'type' => 'git',
                ]
            ]
        );
    }
}
