<?php

namespace App\Exceptions;

class ThrottleException extends AppException
{
    /**
     * ThrottleException (429)
     *
     * @param string $message
     * @param int $code
     */
    public function __construct(
        string $message = "The client has sent too many requests in a given amount of time",
        int    $code = 429
    )
    {
        parent::__construct($message, $code);
    }
}
