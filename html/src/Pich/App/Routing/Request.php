<?php declare(strict_types=1);

namespace Pich\App\Routing;

class Request implements RequestInterface
{
    private array $routeParams = [];

    private array $postData = [];

    private array $merged;

    public function setRouteParams(array $params): void
    {
        $this->routeParams = $params;
    }

    public function getParams(): array
    {
        if (!isset($this->merged)) {
            $this->merged = array_merge($this->getPost(), $this->routeParams);
        }
        return $this->merged;
    }

    /**
     * @param string $param
     * @return mixed
     */
    public function getParam(string $param)
    {
        return $this->getParams()[$param];
    }

    public function getPost(): array
    {
        if (empty($this->postData)) {
            try {
                $this->postData = json_decode($this->getInputStream(), true, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $e) {

            }
        }

        return $this->postData;
    }

    protected function getInputStream(): string
    {
        return file_get_contents('php://input');
    }
}
