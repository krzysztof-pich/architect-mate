<?php declare(strict_types=1);

namespace Pich\User\Tests\Responder;

use Phake_IMock;
use PHPUnit\Framework\TestCase;
use Pich\App\PayloadDTO;
use Pich\App\Response\Json;
use Phake as p;
use Pich\User\Responder\JwtResponder;

class JwtResponderTest extends TestCase
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

    public function testCorrectData(): void
    {
        $payload = new PayloadDTO();
        $payload->setData(['jwt' => 'encoded_jwt_token']);

        $jwtResponder = new JwtResponder($this->json);
        $jwtResponder->setPayload($payload);
        $jwtResponder->send();

        p::verify($this->json)->setData(
            [
                'jwt' => 'encoded_jwt_token'
            ]
        );
    }
}
