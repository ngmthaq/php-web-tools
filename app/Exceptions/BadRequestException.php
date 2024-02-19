<?php

namespace App\Exceptions;

class BadRequestException extends AppException
{
    /**
     * BadRequestException (400)
     *
     * @param string $message
     * @param int $code
     */
    public function __construct(
        string $message = "The server cannot or will not process the request",
        int $code = 400
    ) {
        parent::__construct($message, $code);
    }
}
