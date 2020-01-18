<?php declare(strict_types=1);

namespace Pich\App\Responder;

use Pich\App\PayloadDTO;
use Pich\App\Response\Json;
use Pich\App\Response\ResponseInterface;

abstract class AbstractResponder
{

    protected PayloadDTO $payload;
    protected Json $json;

    public function __construct(Json $json)
    {
        $this->json = $json;
    }

    abstract protected function renderPayloadData(): void;

    public function send(): ResponseInterface
    {
        if ($this->payload->getStatus() === PayloadDTO::INTERNAL_ERROR) {
            $this->json->setStatus(500);
            $this->json->setData(
                [
                    'error' => $this->payload->getStatusMessage() ?: 'Internal error'
                ]
            );
            return $this->json;
        }

        if ($this->payload->getStatus() === PayloadDTO::DUPLICATED_ENTRY) {
            $this->json->setStatus(409);
            $this->json->setData(
                [
                    'error' => $this->payload->getStatusMessage() ?: 'Duplicated entry'
                ]
            );
            return $this->json;
        }

        $this->renderPayloadData();
        return $this->json;
    }

    public function setPayload(PayloadDTO $payload): void
    {
        $this->payload = $payload;
    }
}
