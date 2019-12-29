<?php


namespace Pich\App\Routing;


interface RequestInterface
{
    public function getParams(): array;

    /**
     * @param string $param
     * @return mixed
     */
    public function getParam(string $param);
    public function getPost(): array;
}
