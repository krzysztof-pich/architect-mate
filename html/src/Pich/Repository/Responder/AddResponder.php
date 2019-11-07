<?php declare(strict_types=1);

namespace Pich\Repository\Responder;

use Pich\App\Response\Http;
use Pich\App\Response\ResponseInterface;

class AddResponder
{
    /**
     * @var Http
     */
    private $http;

    public function __construct(Http $http)
    {
        $this->http = $http;
    }

    public function send(): ResponseInterface
    {
        $this->http->setTemplate('Repository/Views/add.twig');
        return $this->http;
    }
}
