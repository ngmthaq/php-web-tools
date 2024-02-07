<?php

namespace App\Http\Exceptions;

/**
 * UnauthorizedException (401)
 */
class UnauthorizedException extends AppException
{
    public function __construct($message = "The client must authenticate itself to get the requested response", $code = 401)
    {
        parent::__construct($message, $code);
    }
}
