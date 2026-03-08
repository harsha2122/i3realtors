<?php

namespace App\Exceptions;

class NotFoundException extends AppException
{
    public function __construct(string $message = 'Resource not found', array $data = [])
    {
        parent::__construct($message, 'NOT_FOUND', 404, $data);
    }
}
