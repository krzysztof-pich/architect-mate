<?php declare(strict_types=1);

namespace Pich\App;

class PayloadDTO
{
    public const NOT_FOUND = 'not-found';
    public const INTERNAL_ERROR = 'internal-error';
    public const DUPLICATED_ENTRY = 'duplicated-entry';

    private string $status = '';
    private string $statusMessage = '';
    private array $data = [];

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): PayloadDTO
    {
        $this->status = $status;
        return $this;
    }

    public function getStatusMessage(): string
    {
        return $this->statusMessage;
    }

    public function setStatusMessage(string $statusMessage): PayloadDTO
    {
        $this->statusMessage = $statusMessage;
        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): PayloadDTO
    {
        $this->data = $data;
        return $this;
    }


}
