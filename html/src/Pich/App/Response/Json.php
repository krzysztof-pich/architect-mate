<?php declare(strict_types=1);

namespace Pich\App\Response;

class Json implements ResponseInterface
{
    /**
     * @var array
     */
    private $data;

    public function setData(array $data = []): void
    {
        $this->data = $data;
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
