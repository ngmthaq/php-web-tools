<?php

namespace App\Http\Exceptions;

/**
 * BadRequestException (400)
 */
class BadRequestException extends AppException
{
    public function __construct($message = "The server cannot or will not process the request", $code = 400)
    {
        parent::__construct($message, $code);
    }
}
