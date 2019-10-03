<?php declare(strict_types=1);

namespace Pich\Main\Responder;

use Pich\App\Response\Http;
use Pich\App\Response\ResponseInterface;

class IndexResponder
{
    /**
     * @var Http
     */
    private $httpResponse;

    public function __construct(Http $httpResponse)
    {
        $this->httpResponse = $httpResponse;
    }

    public function send(): ResponseInterface
    {
        $this->httpResponse->setTemplate('Main/Views/index.twig');
        return $this->httpResponse;
    }
}
