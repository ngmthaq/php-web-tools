<?php

namespace App\Exceptions;

class ServiceUnavailableException extends AppException
{
    /**
     * ServiceUnavailableException (503)
     *
     * @param string $message
     * @param int $code
     */
    public function __construct(
        string $message = "The server is not ready to handle the request",
        int $code = 503
    ) {
        parent::__construct($message, $code);
    }
}
