<?php declare(strict_types=1);

namespace Pich\App\Response;

class Json implements ResponseInterface
{
    /**
     * @var array
     */
    private $data;

    public function setData(array $data = [])
    {
        $this->data = $data;
    }

    public function render(): string
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        return json_encode($this->data);
    }
}
