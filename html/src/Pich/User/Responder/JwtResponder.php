<?php declare(strict_types=1);

namespace Pich\User\Responder;

use Pich\App\Responder\AbstractResponder;

class JwtResponder extends AbstractResponder
{
    protected function renderPayloadData(): void
    {
        $this->json->setData(['jwt' => $this->payload->getData()['jwt']]);
    }
}
