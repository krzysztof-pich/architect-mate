<?php declare(strict_types=1);

namespace Pich\App\Response;

class JsonOptions implements ResponseInterface
{
    public function getHeaders(): array
    {
        return [
            'Access-Control-Allow-Origin: *',
            'Access-Control-Allow-Headers: *',
            'Access-Control-Allow-Credentials: true',
            'Access-Control-Max-Age: 86400',
        ];
    }

    public function getStatus(): int
    {
        return 200;
    }

    public function render(): string
    {
        return json_encode([]);
    }
}
