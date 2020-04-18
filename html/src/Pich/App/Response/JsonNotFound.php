<?php declare(strict_types=1);

namespace Pich\App\Response;

class JsonNotFound implements ResponseInterface
{
    public function getStatus(): int
    {
        return 404;
    }

    public function getHeaders(): array
    {
        return [
            'Access-Control-Allow-Origin: *',
            'Content-Type: application/json; charset=UTF-8',
        ];
    }

    public function render(): string
    {
        return '';
    }
}
