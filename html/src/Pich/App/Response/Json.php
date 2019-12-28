<?php declare(strict_types=1);

namespace Pich\App\Response;

class Json implements ResponseInterface
{
    private array $data = [];
    private int $status = 200;

    public function setData(array $data = []): void
    {
        $this->data = $data;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): int
    {
        return $this->status;
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
        return json_encode($this->data);
    }
}
