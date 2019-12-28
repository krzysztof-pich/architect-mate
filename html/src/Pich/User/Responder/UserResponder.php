<?php declare(strict_types=1);

namespace Pich\User\Responder;

use Pich\App\Response\Json;
use Pich\User\Domain\DTO\User;

class UserResponder
{
    private Json $json;

    public function __construct(Json $json)
    {
        $this->json = $json;
    }

    public function send(User $user): Json
    {
        $this->json->setData([
            'user' => [
                'id' => $user->getId(),
                'email' => $user->getEmail()
            ]
        ]);

        return $this->json;
    }
}
