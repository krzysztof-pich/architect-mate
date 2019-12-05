<?php declare(strict_types=1);

namespace Pich\App;

use Pich\App\Response\Json;

class JsonResponder
{
    /**
     * @var Json
     */
    private $json;

    public function __construct(Json $json)
    {
        $this->json = $json;
    }

    public function send(array $data = [])
    {
        $this->json->setData($data);
        return $this->json;
    }
}
