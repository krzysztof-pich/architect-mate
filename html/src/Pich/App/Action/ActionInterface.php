<?php declare(strict_types=1);


namespace Pich\App\Action;

use Pich\App\Response\ResponseInterface;

interface ActionInterface
{
    public function execute(array $request): ResponseInterface;
}
