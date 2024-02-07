<?php

namespace App\Http\Exceptions;

/**
 * ThrottleException (401)
 */
class ThrottleException extends AppException
{
    public function __construct($message = "The client has sent too many requests in a given amount of time", $code = 429)
    {
        parent::__construct($message, $code);
    }
}
