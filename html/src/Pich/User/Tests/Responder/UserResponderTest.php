<?php

namespace Pich\User\Tests\Responder;

use Phake_IMock;
use Pich\App\PayloadDTO;
use Pich\App\Response\Json;
use Pich\User\Domain\DTO\User;
use Pich\User\Responder\UserResponder;
use PHPUnit\Framework\TestCase;
use Phake as p;

class UserResponderTest extends TestCase
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

    public function testSend(): void
    {
        $email = 'test@pich.pl';
        $id = 1;
        $user = new User();
        $user
            ->setId($id)
            ->setPassword('password_hash')
            ->setEmail($email);

        $payload = new PayloadDTO();
        $payload->setData(['user' => $user]);

        $userResponder = new UserResponder($this->json);
        $userResponder->setPayload($payload);
        $userResponder->send();

        p::verify($this->json)->setData(
            [
                'user' => ['id' => $id, 'email' => $email]
            ]
        );
    }
}
