<?php

namespace App\Exceptions;

/**
 * BadRequestException (400)
 */
class BadRequestException extends AppException
{
    public function __construct(
        string $message = "The server cannot or will not process the request",
        int $code = 400
    ) {
        parent::__construct($message, $code);
    }
}
