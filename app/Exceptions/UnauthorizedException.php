<?php

namespace App\Exceptions;

/**
 * UnauthorizedException (401)
 */
class UnauthorizedException extends AppException
{
    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(
        string $message = "The client must authenticate itself to get the requested response",
        int $code = 401
    ) {
        parent::__construct($message, $code);
    }
}
