<?php declare(strict_types=1);


namespace Pich\App\Action;

use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\RequestInterface;

interface ActionInterface
{
    public function execute(RequestInterface $request): ResponseInterface;
}
