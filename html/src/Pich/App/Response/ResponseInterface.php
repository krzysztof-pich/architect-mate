<?php


namespace Pich\App\Response;


interface ResponseInterface
{
    public function getHeaders(): array;
    public function render(): string;
}
