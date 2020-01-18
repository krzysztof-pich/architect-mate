<?php declare(strict_types=1);

namespace Pich\User\Responder;

use Pich\App\PayloadDTO;
use Pich\App\Response\Json;
use Pich\App\Response\ResponseInterface;
use Pich\User\Domain\DTO\User;

class UserResponder
{
    private Json $json;
    private PayloadDTO $payload;

    public function __construct(Json $json)
    {
        $this->json = $json;
    }

    public function setPayload(PayloadDTO $payload): void
    {
        $this->payload = $payload;
    }

    protected function renderPayloadData(): void
    {
        $user = $this->payload->getData()['user'];
        $this->json->setData(
            [
                'user' => [
                    'id'    => $user->getId(),
                    'email' => $user->getEmail(),
                ],
            ]
        );
    }

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
}
