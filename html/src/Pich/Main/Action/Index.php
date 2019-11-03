<?php declare(strict_types=1);

namespace Pich\Main\Action;

use Pich\App\Action\ActionInterface;
use Pich\App\Database;
use Pich\App\Response\Http;
use Pich\App\Response\ResponseInterface;
use Pich\Main\Responder\IndexResponder;

class Index implements ActionInterface
{
    /**
     * @var IndexResponder
     */
    private $indexResponder;

    public function __construct(IndexResponder $indexResponder)
    {
        $this->indexResponder = $indexResponder;
    }

    public function execute(array $request): ResponseInterface
    {
        return $this->indexResponder->send();
    }
}
