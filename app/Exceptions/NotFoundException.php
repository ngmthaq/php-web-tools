<?php

namespace App\Exceptions;

/**
 * NotFoundException (404)
 */
class NotFoundException extends AppException
{
    public function __construct(
        string $message = "The server cannot find the requested resource",
        int $code = 404
    ) {
        parent::__construct($message, $code);
    }
}
