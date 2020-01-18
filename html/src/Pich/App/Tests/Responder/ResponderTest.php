<?php

namespace Pich\App\Tests\Responder;

use Phake_IMock;
use Pich\App\PayloadDTO;
use Pich\App\Responder\AbstractResponder;
use PHPUnit\Framework\TestCase;
use Pich\App\Response\Json;
use Phake as p;

class ResponderTest extends TestCase
{
    /**
     * @var Json|Phake_IMock
     */
    private $json;

    public function setUp(): void
    {
        parent::setUp();
        $this->json = p::mock(Json::class);
    }

    public function testError(): void
    {
        $statusMessage = 'database error';
        $payload = new PayloadDTO();
        $payload->setStatus(PayloadDTO::INTERNAL_ERROR);
        $payload->setStatusMessage($statusMessage);

        $responder = p::partialMock(AbstractResponder::class, $this->json);
        $responder->setPayload($payload);
        $responder->send();

        p::verify($this->json)->setStatus(500);
        p::verify($this->json)->setData(
            [
                'error' => $statusMessage
            ]
        );
    }

    public function testDuplicatedError(): void
    {
        $statusMessage = 'Duplicated error';
        $payload = new PayloadDTO();
        $payload->setStatus(PayloadDTO::DUPLICATED_ENTRY);
        $payload->setStatusMessage($statusMessage);

        $responder = p::partialMock(AbstractResponder::class, $this->json);
        $responder->setPayload($payload);
        $responder->send();

        p::verify($this->json)->setStatus(409);
        p::verify($this->json)->setData(
            [
                'error' => $statusMessage
            ]
        );
    }
}
