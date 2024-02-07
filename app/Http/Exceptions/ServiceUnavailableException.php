<?php

namespace App\Http\Exceptions;

/**
 * ServiceUnavailableException (401)
 */
class ServiceUnavailableException extends AppException
{
    public function __construct($message = "The server is not ready to handle the request", $code = 503)
    {
        parent::__construct($message, $code);
    }
}
