<?php


namespace Pich\App\Response;


interface ResponseInterface
{
    public function getHeaders(): array;
    public function getStatus(): int;
    public function render(): string;
}
