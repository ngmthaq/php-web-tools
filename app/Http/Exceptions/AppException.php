<?php

namespace App\Http\Exceptions;

use Exception;

class AppException extends Exception
{
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
