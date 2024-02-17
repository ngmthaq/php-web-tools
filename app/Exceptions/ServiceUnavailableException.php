<?php

namespace App\Exceptions;

/**
 * ServiceUnavailableException (401)
 */
class ServiceUnavailableException extends AppException
{
    /**
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
