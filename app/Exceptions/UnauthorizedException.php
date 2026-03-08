<?php

namespace App\Exceptions;

class UnauthorizedException extends AppException
{
    public function __construct(string $message = 'Unauthorized action', array $data = [])
    {
        parent::__construct($message, 'UNAUTHORIZED', 403, $data);
    }
}
