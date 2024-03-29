<?php

namespace App\Exceptions;

use Exception;

class AppException extends Exception
{
    /**
     * AppException
     *
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message = "", int $code = 0)
    {
        parent::__construct($message, $code);
    }
}
