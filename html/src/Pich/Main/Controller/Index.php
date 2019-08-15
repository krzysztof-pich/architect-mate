<?php declare(strict_types=1);

namespace Pich\Main\Controller;

use Pich\App\Controller\ControllerInterface;

class Index implements ControllerInterface
{
    public function execute()
    {
        return 'Hello World!';
    }
}
