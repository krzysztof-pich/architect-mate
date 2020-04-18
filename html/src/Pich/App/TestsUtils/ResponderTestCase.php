<?php declare(strict_types=1);

namespace Pich\App\TestsUtils;

use Pich\App\PayloadDTO;
use Pich\App\Response\ResponseInterface;
use Pich\App\Routing\RequestInterface;
use PHPUnit\Framework\TestCase;
use Phake as p;

abstract class ResponderTestCase extends TestCase
{
    /**
     * @return PayloadDTO
     */
    protected function createTestPayload(): PayloadDTO
    {
        $payload = new PayloadDTO();
        $payload->setData(['test' => 'test']);
        return $payload;
    }

    /**
     * @param string $domainClass
     * @param string $responderClass
     * @return array
     */
    protected function createDomainResponderMock(string $domainClass, string $responderClass): array
    {
        $request = p::mock(RequestInterface::class);
        $domain = p::mock($domainClass);
        $responder = p::mock($responderClass);

        p::when($responder)->send()->thenReturn(p::mock(ResponseInterface::class));

        return [$request, $domain, $responder];
    }
}
