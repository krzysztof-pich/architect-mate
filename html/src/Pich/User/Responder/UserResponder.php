<?php declare(strict_types=1);

namespace Pich\User\Responder;

use Pich\App\Responder\AbstractResponder;

class UserResponder extends AbstractResponder
{
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

}
