<?php

namespace App\Exceptions;

use Exception;

class AppException extends Exception
{
    protected string $errorCode;
    protected array $data;

    public function __construct(
        string $message = '',
        string $errorCode = 'APP_ERROR',
        int $statusCode = 500,
        array $data = []
    ) {
        parent::__construct($message, $statusCode);
        $this->errorCode = $errorCode;
        $this->data = $data;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getStatusCode(): int
    {
        return $this->getCode();
    }
}
